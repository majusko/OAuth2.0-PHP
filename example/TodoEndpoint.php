<?php

require_once("../service/ErrorHandlerService.php");
require_once("DeviceDaoImpl.php");
require_once("TodoService.php");
require_once("../service/AuthService.php");

/**
 * This is example endpoint of using oAuth2.0 library
 */

$method = $_SERVER['REQUEST_METHOD'];
$request = explode("/", substr(@$_SERVER['PATH_INFO'], 1));

$errorHandler = ErrorHandlerService::getInstance();
$deviceDao = DeviceDaoImpl::getInstance();
$todoService = TodoService::getInstance();
$authService = AuthService::getInstance($deviceDao);

try{
    switch ($method) {
            case 'PUT':
                $authService->auth();
                $todoService->addTodo(new Todo());
                break;
            case 'POST':
                $authService->auth();
                $todoService->editTodo(new Todo());
                break;
            case 'GET':
                $authService->auth();
                $todoService->getTodo(1);
                break;
            case 'DELETE':
                $authService->auth();
                $todoService->deleteTodo(1);
                break;
            default:
                throw new RestException("Unknown request method", 405);
                break;
    }
} catch (Exception $e){
        $errorHandler->handleException($e);
}