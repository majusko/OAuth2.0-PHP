<?php

/**
 * Class ErrorDto
 * is data transfer object for error messages.
 */
class ErrorDto {

    public $code;
    public $message;

    function __construct($code, $message) {
        $this->code = $code;
        $this->message = $message;
    }

    /**
     * @param mixed $code - HTTP status code.
     */
    public function setCode($code)
    {
        $this->code = $code;
    }

    /**
     * @return mixed - HTTP status code.
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param mixed $message - Explanation message.
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }

    /**
     * @return mixed - Explanation message.
     */
    public function getMessage()
    {
        return $this->message;
    }

} 