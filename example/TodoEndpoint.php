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
                echo "add your resource";
                //TODO add your resource
                break;
            case 'POST':
                $authService->auth();
                echo "update your resource";
                //TODO update your resource
                break;
            case 'GET':
                $authService->auth();
                echo "get your resource";
                //TODO get your resource
                break;
            case 'DELETE':
                $authService->auth();
                echo "delete your resource";
                //TODO delete your resource
                break;
            default:
                throw new RestException("Unknown request method", 405);
                break;
    }
} catch (Exception $e){
        $errorHandler->handleException($e);
}
