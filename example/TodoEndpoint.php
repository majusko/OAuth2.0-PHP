<?php

require_once("../service/Service_ErrorHandlerService.php");
require_once("DeviceDaoImpl.php");
require_once("TodoService.php");
require_once("../service/Service_AuthService.php");

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
                $todoService->addTodo(new Todo());
                break;
            case 'POST':
                $todoService->editTodo(new Todo());
                break;
            case 'GET':
                $authService->auth();
                $todoService->getTodo(1);
                break;
            case 'DELETE':
                $todoService->deleteTodo(1);
                break;
            default:
                throw new RestException("Unknown REQUEST_METHOD", 400);
                break;
    }
} catch (Exception $e){
        $errorHandler->handleException($e);
}