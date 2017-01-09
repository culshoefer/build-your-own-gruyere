<?php
namespace BYOG;

require_once('components/SuperHelper.php');
require_once('components/Login.php');
require_once('controllers/APIController.php');
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
            default:
                SuperHelper::redirectoTo('/home');
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
        resolveMemberRoutings($uri);
    } elseif(Login::wantsToLogin()) {
        //do some login action
    } elseif(Login::wantsToRegister()) {
        //do some registration action
    } else {
        include_once('views/login.php');//sorry :(
    }
} else {
    echo "Sorry, unable to create session :(";
}
