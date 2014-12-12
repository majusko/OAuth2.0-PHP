<?php

/**
 * Class ErrorHandlerService
 * is service layer class which handle exceptions.
 */
class ErrorHandlerService {

    private static $instances = array();
    protected function __construct() {}
    protected function __clone() {}
    protected function __wakeup(){
        //Cant throw exception in handler.
    }

    public static function getInstance(){

        $classes = get_called_class();
        if (!isset(self::$instances[$classes])) {
            self::$instances[$classes] = new static;
        }

        return self::$instances[$classes];
    }

    /**
     * Handling exceptions by type and http status code.
     * @param Exception $e - thrown exception
     */
    public function handleException(Exception $e){

        if ($e instanceof RestException) {
            switch($e->getCode()){
                case(ErrorCode::FORBIDDEN_ACCESS):
                    $this->resolveResponse(ErrorHeader::FORBIDDEN_ACCESS, $e);
                    break;
                case(ErrorCode::RESOURCE_NOT_FOUND):
                    $this->resolveResponse(ErrorHeader::RESOURCE_NOT_FOUND, $e);
                    break;
                case(ErrorCode::INTERNAL_ERROR):
                    $this->resolveResponse(ErrorHeader::INTERNAL_ERROR, $e);
                    break;
                case(ErrorCode::INVALID_INPUT):
                    $this->resolveResponse(ErrorHeader::INVALID_INPUT, $e);
                    break;
                case(ErrorCode::RESOURCE_ALREADY_EXISTS):
                    $this->resolveResponse(ErrorHeader::RESOURCE_ALREADY_EXISTS, $e);
                    break;
                case(ErrorCode::UNAUTHORIZED_ACCESS):
                    $this->resolveResponse(ErrorHeader::UNAUTHORIZED_ACCESS, $e);
                    break;
            }
        } else {
            header(ErrorHeader::INTERNAL_ERROR, true, ErrorCode::INTERNAL_ERROR);
        }

    }

    /**
     * @param $header - Header string value
     * @param $e
     */
    private function resolveResponse($header, $e){
        header($header, true, $e->getCode());
        header(JSON_HEADER);
        echo json_encode(new ErrorDto($e->getCode(), $e->getMessage()));
    }

} 