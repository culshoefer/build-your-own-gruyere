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
                if (Login::loggedIn()) {
                    SuperHelper::redirectoTo('/loggedin');
                    break;
                }
                View::render('homepage.php');
                break;
            case 'api':
                return APIController::handle($uriComponents);
            case 'post':
                return POSTController::handle($uriComponents);
            case 'login':
                View::render('login.php');
                break;
            case 'loggedin':
                View::render('loggedin.php');
                break;
            case 'mySnippets':
                View::render('mySnippets.php');
                break;
            case 'settings':
                View::render('settings.php');
                break;
            case 'upload':
                FileUploader::upload();
                SuperHelper::redirectoTo('/loggedin');
                break;
            case 'logout':
                Login::logout();
                SuperHelper::redirectoTo('/');
                break;
            default:
                SuperHelper::give404();
        }
    }
}