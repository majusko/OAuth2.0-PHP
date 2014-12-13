<?php

$ROOT = dirname(__FILE__);

require_once($ROOT . "/oauth/OAuthInit.php");
require_once($ROOT . "/DeviceDaoImpl.php");
require_once($ROOT . "/UserDaoImpl.php");

/**
 * This is example endpoint of using oAuth2.0 library
 */

$method = $_SERVER['REQUEST_METHOD'];

//implemented instances
$deviceDao = DeviceDaoImpl::getInstance();
$userDao = UserDaoImpl::getInstance();

//lib instances
$authService = AuthService::getInstance($deviceDao,$userDao);
$errorHandler = ErrorHandlerService::getInstance();

try{
    $authService->tokenEndpoint();
} catch (Exception $e){
    $errorHandler->handleException($e);
//    throw $e;
}