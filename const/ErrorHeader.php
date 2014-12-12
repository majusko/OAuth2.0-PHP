<?php
/**
 * Created by PhpStorm.
 * User: eglu
 * Date: 11/12/14
 * Time: 20:31
 */

class ErrorHeader {

    const INVALID_INPUT = "HTTP/1.1 400 Bad Request";
    const UNAUTHORIZED_ACCESS = "HTTP/1.1 401 Unauthorized";
    const FORBIDDEN_ACCESS = "HTTP/1.1 403 Forbidden";
    const RESOURCE_NOT_FOUND = "HTTP/1.1 404 Not Found";
    const RESOURCE_ALREADY_EXISTS = "HTTP/1.1 409 Conflict";
    const INTERNAL_ERROR = "HTTP/1.1 500 Internal Server Error";

} 