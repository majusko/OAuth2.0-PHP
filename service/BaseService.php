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

} 