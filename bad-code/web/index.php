<?php
namespace BYOG;

require_once('components/SuperHelper.php');
require_once('components/Login.php');
require_once('controllers/APIController.php');
use BYOG\Components\Registration;
use BYOG\Controllers\APIController;
use BYOG\Components\SuperHelper;
use BYOG\Components\Login;

#include 'includes/header.php';
/**
 * @param $uri
 */
function resolveMemberRoutings($uri)
{
    if(sizeof($uri) == 1) {
        switch ($uri[0]) {
            case "settings": {
                include_once('views/settings.php');
                break;
            }
            case "home": {
                include_once('views/homepage.php');
                break;
            }
            case "loggedin": {
                include_once('views/loggedin.php');
                break;
            }
            case "my_snippets": {
                include_once('views/mySnippets.php');
                break;
            }
            default:
                SuperHelper::redirectoTo('/loggedin');
        }
    } else if (sizeof($uri) == 2 && $uri[0] == "api") {
        echo APIController::handle($_SERVER);
    } else {
        SuperHelper::redirectoTo('/home');
    }
}

if(session_start()) {
    $uri = SuperHelper::getPath();
    $method = $_SERVER['REQUEST_METHOD'];
    if(Login::isLoggedIn()) {//user logged in, all good
        echo 'true';
        resolveMemberRoutings($uri);
    } elseif(Login::wantsToLogin()) {
        //echo 'wantstologin';
        Login::attemptLogin();
    } elseif(Login::wantsToRegister()) {
        Registration::registerUser($_POST['username'], $_POST['password']);
        Login::attemptLogin();
        //SuperHelper::redirectoTo('/');
    } else {
        //echo 'not logged in or so';
        if(sizeof($uri) == 1) {
            if($uri[0] == 'home') {
                include_once('views/homepage.php');
            } else if($uri[0] == 'logout') {
                Login::logout();
                SuperHelper::redirectoTo('/');
            } else {
                include_once('views/login.php');
            }
        } else {
            include_once('views/login.php');//sorry :(
        }
    }
} else {
    echo "Sorry, unable to create session :(";
}
