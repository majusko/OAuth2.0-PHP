<?php

require_once("../domain/Device.php");

/**
 * Class AuthService
 * is base service class for whole authorization process.
 */
class AuthService extends BaseService {

    private $deviceService;

    private static $deviceDao;
    private static $instances = array();

    private function __construct() {
        $this->deviceService = DeviceService::getInstance();
    }
    private function __clone() {}
    public function __wakeup(){throw new Exception("Serialized singleton!");}

    public static function getInstance(DeviceDaoInt $deviceDaoImpl){

        $classes = get_called_class();

        if (!isset(self::$instances[$classes])) {
            self::$instances[$classes] = new static;
        }

        self::$deviceDao = $deviceDaoImpl;

        return self::$instances[$classes];

    }

    /**
     * Base method for authorization any request to endpoint.
     * @throws RestException - throws exception if token is expired.
     */
    public function auth(){

        $accessToken = $this->getAuthToken();
        $device = self::$deviceDao->getDeviceByAccessToken($accessToken);
        $this->deviceService->validateStrictDeviceType($device);

        if($device->getExpireToken() < time()){
            throw new RestException(AuthCommon::EXPIRED_TOKEN_MESSAGE,ErrorCode::UNAUTHORIZED_ACCESS);
        }

        //TODO Implementation of user role check solution with 403 HTTP Status response.

    }

    /**
     * First step validation for requesting new token.
     */
    public function firstStepValidation(){
        $this->checkClientId($_POST[AuthCommon::CLIENT_ID]);
        $this->checkClientSecret($_POST[AuthCommon::CLIENT_SECRET]);
    }

    /**
     * Simple check of client id.
     * @param $value
     * @throws RestException
     */
    public function checkClientId($value){
        if($value != AuthConfig::CLIENT_ID){
            throw new RestException("Client id missing",ErrorCode::UNAUTHORIZED_ACCESS);
        }
    }

    /**
     * Simple check of client secret.
     * @param $value
     * @throws RestException
     */
    public function checkClientSecret($value){
        if($value != AuthConfig::CLIENT_SECRET){
            throw new RestException("Client id missing",ErrorCode::UNAUTHORIZED_ACCESS);
        }
    }

    /**
     * Gets authorization token from header.
     * @return mixed - String value of authorization token stored in header.
     */
    private function getAuthToken(){

        $headers = $this->getallheaders();

        $this->validateHeaders($headers);

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