<?php

/**
 * Class RestException
 * is custom exception for error handler.
 */
class RestException extends Exception {

    public $code;
    public $message;

    public function __construct($message, $code = 0, Exception $previous = null) {
        parent::__construct($message, $code, $previous);
    }

    /**
     * @param mixed $code - Error code
     */
    public function setCode($code)
    {
        $this->code = $code;
    }

    /**
     * @param mixed $message - Error message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }

} 