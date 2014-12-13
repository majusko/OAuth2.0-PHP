<?php

/**
 * Class AuthService
 * is base service class for whole authorization process.
 */
class AuthService extends BaseService {

    private $deviceService;
    private $userService;

    private static $deviceDao;
    private static $userDao;
    private static $instances = array();

    private function __construct() {
        $this->deviceService = DeviceService::getInstance();
        $this->userService = UserService::getInstance();
    }
    private function __clone() {}
    public function __wakeup(){throw new Exception("Serialized singleton!");}

    public static function getInstance(DeviceDaoInt $deviceDaoImpl, UserDaoInt $userDaoImpl){

        $classes = get_called_class();

        if (!isset(self::$instances[$classes])) {
            self::$instances[$classes] = new static;
        }

        self::$deviceDao = $deviceDaoImpl;
        self::$userDao = $userDaoImpl;

        return self::$instances[$classes];

    }

    /**
     * TokenEndpoints is implementation of token endpoint where you are asking for new token
     * with authorization code, login and password or refresh token.
     * @throws RestException
     */
    public function tokenEndpoint(){

        if(empty($_POST[AuthCommon::CLIENT_ID]) ||
            empty($_POST[AuthCommon::CLIENT_SECRET]) ||
            empty($_POST[AuthCommon::GRAND_TYPE])){
            throw new RestException("Client id, client secret, grand type is missing.",ErrorCode::UNAUTHORIZED_ACCESS);
        }

        $this->checkClientId($_POST[AuthCommon::CLIENT_ID]);
        $this->checkClientSecret($_POST[AuthCommon::CLIENT_SECRET]);

        $installationId = null;
        $userId = null;

        if(!empty($_POST[AuthCommon::INSTALLATION_ID])){
            $installationId = $_POST[AuthCommon::INSTALLATION_ID];
        }

        switch($_POST[AuthCommon::GRAND_TYPE]){

            case AuthCommon::GRAND_TYPE_REFRESH_TOKEN:
                $device = $this->checkRefreshGrandType($_POST[AuthCommon::REFRESH_TOKEN]);
                break;
            case AuthCommon::GRAND_TYPE_PASSWORD:

                if(empty($_POST[AuthCommon::EMAIL]) ||
                    empty($_POST[AuthCommon::PASSWORD])){
                    throw new RestException("Email or password is missing.",ErrorCode::UNAUTHORIZED_ACCESS);
                }

                $user = $this->checkPasswordGrandType($_POST[AuthCommon::EMAIL],$_POST[AuthCommon::PASSWORD]);
                $device = self::$deviceDao->getDeviceByUserIdAndInstallationId($user->getId(),$installationId);

                if(!empty($user)){
                    $userId = $user->getId();
                }

                break;
            case AuthCommon::GRAND_TYPE_AUTHORIZATION_CODE:
                //TODO implementation of token which can be used for user registration endpoint(or something else).
                throw new RestException("Grand type for authorization code is not implemented yet.", ErrorCode::UNAUTHORIZED_ACCESS);
                break;
            default:
                throw new RestException("Unknown grand type.", ErrorCode::UNAUTHORIZED_ACCESS);
                break;

        }

        $device = $this->handleDevice($device, $installationId, $userId);

        echo json_encode(new TokenDto($device));

    }

    /**
     * Base method for authorization any request to endpoint.
     * @throws RestException - throws exception if token is expired.
     */
    public function auth(){

        $accessToken = $this->getAuthToken();
        $device = self::$deviceDao->getDeviceByAccessToken($accessToken);
        $this->deviceService->validateStrictDeviceType($device);
        $date = new DateTime();

        if($device->getExpireToken() < $date->getTimestamp()){
            throw new RestException(AuthCommon::EXPIRED_TOKEN_MESSAGE,ErrorCode::UNAUTHORIZED_ACCESS);
        }

        //TODO Implementation of user role check solution with 403 HTTP Status response.

    }

    /**
     * Handling device to be changed in database and also refresh new access and refresh token.
     * @param $device
     * @param null $installationId
     * @param null $userId
     * @return Device
     */
    private function handleDevice($device, $installationId = null, $userId = null){

        $accessToken = bin2hex(openssl_random_pseudo_bytes(16));
        $refreshToken = bin2hex(openssl_random_pseudo_bytes(16));
        $interval = DateInterval::createfromdatestring('+1 hour');
        $dt = new DateTimeEnhanced();
        $dtNew = $dt->returnAdd($interval);
        $dbAccessToken = $device->getAccessToken();

        if(empty($device) || empty($dbAccessToken)){

            $device = new Device($accessToken,$dtNew->getTimestamp(), $installationId, $refreshToken, $userId);

            self::$deviceDao->insert($device);
        } else {

            $device->setAccessToken($accessToken);
            $device->setRefreshToken($refreshToken);
            $device->setExpireToken($dtNew->getTimestamp());

            self::$deviceDao->update($device);
        }

        return $device;

    }

    private function checkRefreshGrandType($refreshToken){

        $device = self::$deviceDao->getDeviceByRefreshToken($refreshToken);

        $this->deviceService->validateStrictDeviceType($device);
        $dbAccessToken = $device->getAccessToken();

        if(empty($device) || empty($dbAccessToken)){
            throw new RestException("Refresh token does not exists.",ErrorCode::UNAUTHORIZED_ACCESS);
        }

        return $device;

    }

    /**
     * Check if user exists with such login and password.
     * @param $login
     * @param $password
     * @return mixed
     * @throws RestException
     */
    private function checkPasswordGrandType($login, $password){

        $user = self::$userDao->getUserForAuthByLoginAndPassword($login, $password);
        $this->userService->validateStrictUserType($user);
        $id = $user->getId();

        if(empty($user) || empty($id) || !is_numeric($id)){
            throw new RestException("Can't login.",ErrorCode::UNAUTHORIZED_ACCESS);
        }

        return $user;

    }

    /**
     * Simple check of client id.
     * @param $value
     * @throws RestException
     */
    private function checkClientId($value){
        if($value != AuthConfig::CLIENT_ID){
            throw new RestException("Client id is invalid.",ErrorCode::UNAUTHORIZED_ACCESS);
        }
    }

    /**
     * Simple check of client secret.
     * @param $value
     * @throws RestException
     */
    private function checkClientSecret($value){
        if($value != AuthConfig::CLIENT_SECRET){
            throw new RestException("Client secret is invalid.",ErrorCode::UNAUTHORIZED_ACCESS);
        }
    }

    /**
     * Gets authorization token from header.
     * @return mixed - String value of authorization token stored in header.
     * @throws RestException
     */
    private function getAuthToken(){

        $headers = $this->getallheaders();

        $this->validateHeaders($headers);

        if(empty($headers[AuthCommon::HEADER_AUTHORIZATION])){
            throw new RestException(AuthCommon::INVALID_TOKEN_MESSAGE,401);
        }

        $authToken = $this->trimCommonStarters($headers[AuthCommon::HEADER_AUTHORIZATION]);

        $this->validateAuthToken($authToken);

        return $authToken;


    }

    /**
     * Trim common starters from beginning of header
     * @param $headerAccessToken - fresh access token from header.
     * @return mixed - trimmed access token.
     */
    private function trimCommonStarters($headerAccessToken){

        $result = str_ireplace(AuthCommon::BEARER, Common::EMPTY_STRING ,$headerAccessToken);
        $result = str_ireplace(AuthCommon::BASIC, Common::EMPTY_STRING ,$result);

        return $result;

    }

    /**
     * Some basic validation of auth token. Token should be longer then 5 characters.
     * @param $accessToken - trimmed access token
     * @throws RestException - if token is not valid - Exception will be thrown.
     */
    private function validateAuthToken($accessToken){
        if(empty($accessToken) || strlen($accessToken) <= 5){
            throw new RestException(AuthCommon::INVALID_TOKEN_MESSAGE,401);
        }
    }

}