<?php

/**
 * Class AuthService
 * is base service class for whole authorization process.
 */
class AuthService extends BaseService {

    private static $deviceDao;
    private static $instances = array();
    protected function __construct() {}
    protected function __clone() {}
    public function __wakeup(){throw new Exception("Serialized singleton!");}

    public static function getInstance(DeviceDaoInt $deviceDaoImpl){

        $classes = get_called_class();

        if (!isset(self::$instances[$classes])) {
            self::$instances[$classes] = new static;
        }

        self::$deviceDao = $deviceDaoImpl;

        return self::$instances[$classes];

    }

    public function auth(){

        $accessToken = $this->getAuthToken();
        $device = self::$deviceDao->getDeviceByAccessToken($accessToken);


    }

    /**
     * Gets authorization token from header.
     * @return mixed - String value of authorization token stored in header.
     */
    private function getAuthToken(){

        $headers = getallheaders();

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