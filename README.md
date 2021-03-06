OAuth2.0-PHP
============

PHP library for OAuth2.0 implementation - beta 1.0

Current example project with included library works without any special setup. You can use included oAuth_2_0.json to test created endpoints with Postman.

PHP version >= 5.3

Installation:

1. Download/clone project
2. Copy /oauth/ folder into your project and include OAuthInit.php file.

    require_once($ROOT . "/oauth/OAuthInit.php");
3. Edit oauth/const/AuthCommon.php and setup all your key constants (client_id,constants,...)

4. Write implementation of DeviceDaoInt and UserDaoInt.

5. Setup AuthService and ErrorHandlerService instances

    $deviceDao = DeviceDaoImpl::getInstance();
    $userDao = UserDaoImpl::getInstance();
    
    $authService = AuthService::getInstance($deviceDao,$userDao);
    $errorHandler = ErrorHandlerService::getInstance();

6. Use our exception handler for responses
    try{
      //ENDPOINT
    } catch (Exception $e){
            $errorHandler->handleException($e);
    }

7. Use auth methode where you need.

    $authService->auth();
    
