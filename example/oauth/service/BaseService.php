<?php


/**
 * Class BaseService
 * Base class for whole service layer with some common functionality.
 */
class BaseService {

    protected function validateHeaders($headers){
        if(empty($headers) || !is_array($headers)){
            throw new RestException("Missing access token.",401);
        }
    }

    /**
     * Fetch all headers in request. Using native function but also using provisional solution
     * @return string
     */
    protected function getAllHeaders(){

        if (!function_exists('getallheaders')) {
            $headers = '';
            foreach ($_SERVER as $name => $value) {
                if (substr($name, 0, 5) == 'HTTP_') {
                    $headers[str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($name, 5)))))] = $value;
                }
            }
            return $headers;
        }

        return getallheaders();

    }

} 