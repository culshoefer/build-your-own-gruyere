<?php
/**
 * Created by PhpStorm.
 * User: timbokz
 * Date: 10/01/17
 * Time: 15:15
 */

namespace BYOG\Components;

use BYOG\Controllers\APIController;
use BYOG\Controllers\POSTController;

class App
{

    private static $instance = null;

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new App();
        }
        return self::$instance;
    }

    public function start()
    {
        $uriComponents = SuperHelper::getPath();

        if(Login::wantsToLogin() && !Login::loggedIn()) {
            Login::attemptLogin();
            SuperHelper::redirectoTo('/loggedin');
        }

        if (!Login::loggedIn() && !in_array($uriComponents[0], array('', 'login'))) {
            SuperHelper::redirectoTo('/login');
        }

        switch ($uriComponents[0]) {
            case '':
                if (Login::loggedIn())
                    return SuperHelper::redirectoTo('/loggedin');
                return View::render('homepage.php');
            case 'api':
                return APIController::handle($uriComponents);
            case 'post':
                return POSTController::handle($uriComponents);
            case 'loggedin':
                return View::render('loggedin.php');
            case 'mySnippets':
                return View::render('mySnippets.php');
            case 'settings':
                return View::render('settings.php');
            case 'logout':
                Login::logout();
                return SuperHelper::redirectoTo('/');
            default:
                SuperHelper::give404();
        }

        if ($uriComponents[0] === 'api') {
            APIController::handle($uriComponents);
        }
    }
}