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

    public static function getSecureData() {
        return md5('hello world');
    }

    public function start()
    {
        $uriComponents = SuperHelper::getPath();

        SuperHelper::redirectIfPossible();

        if (in_array($uriComponents[0], array('assets', 'uploads'))) {
            $path = __DIR__ . '/../' . implode('/', $uriComponents);
            if (file_exists($path)) {
                header('Content-Type: ' . SuperHelper::content_type($path));
                //header('Content-Type: text/css');
                include $path;
                die();
            } else {
                SuperHelper::give404();
                die('Page Not Found');
            }
        }

        if (Login::wantsToLogin() && !Login::loggedIn()) {
            Login::attemptLogin();
            SuperHelper::redirectoTo('/loggedin');
            die();
        }

        if (!Login::loggedIn() && !in_array($uriComponents[0], array('', 'login', 'api'))) {
            SuperHelper::give401();
            SuperHelper::redirectoTo('/login');
            die();
        }

        switch ($uriComponents[0]) {
            case '':
                if (Login::loggedIn()) {
                    SuperHelper::redirectoTo('/loggedin');
                    die();
                }
                View::render('homepage.php');
                break;
            case 'api':
                return APIController::handle($uriComponents);
            case 'post':
                return POSTController::handle($uriComponents);
            case 'login':
                if (Login::loggedIn()) {
                    SuperHelper::redirectoTo('/loggedin');
                    die();
                }
                View::render('login.php');
                break;
            case 'loggedin':
                View::render('loggedin.php');
                break;
            case 'upload':
                FileUploader::upload();
                SuperHelper::redirectoTo('/loggedin');
                die();
                break;
            case 'mysnippets':
                View::render('mySnippets.php');
                break;
            case 'settings':
                View::render('settings.php');
                break;
            case 'logout':
                Login::logout();
                SuperHelper::redirectoTo('/');
                die();
            default:
                SuperHelper::give404();
                die();
        }
    }
}