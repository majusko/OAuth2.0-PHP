OAuth2.0-PHP
============

PHP library for OAuth2.0 implementation - beta 1.0

Installation:

1. Download project
2. Copy /oauth/ folder into your project and include OAuthInit.php file.

require_once($ROOT . "/oauth/OAuthInit.php");

3. Write implementation of DeviceDaoInt and UserDaoInt.

4. Setup AuthService and ErrorHandlerService instances

$deviceDao = DeviceDaoImpl::getInstance();
$userDao = UserDaoImpl::getInstance();

$authService = AuthService::getInstance($deviceDao,$userDao);
$errorHandler = ErrorHandlerService::getInstance();

5. Use our exception handler for responses
try{
  //ENDPOINT
} catch (Exception $e){
        $errorHandler->handleException($e);
}

6. Use auth methode where you need.

$authService->auth();
