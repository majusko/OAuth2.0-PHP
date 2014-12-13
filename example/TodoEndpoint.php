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
    switch ($method) {
            case 'PUT':
                $authService->auth();
                echo "add your record";
                //TODO add your record
                break;
            case 'POST':
                $authService->auth();
                echo "update your record";
                //TODO update your record
                break;
            case 'GET':
                $authService->auth();
                echo "get your record";
                //TODO get your record
                break;
            case 'DELETE':
                $authService->auth();
                echo "delete your record";
                //TODO delete your record
                break;
            default:
                throw new RestException("Unknown request method", 405);
                break;
    }
} catch (Exception $e){
        $errorHandler->handleException($e);
//    throw $e;
}