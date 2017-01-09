<?php
namespace BYOG;

require_once('components/SuperHelper.php');
require_once('controllers/APIController.php');
use BYOG\Controllers\APIController;
use BYOG\Components\SuperHelper;

#include 'includes/header.php';
/**
 * @param $uri
 */
function resolveRoutings($uri)
{
    switch ($uri[0]) {
        case "settings": {
            echo file_get_contents('frontend/settings.html');
            break;
        }
        case "home": {
            echo file_get_contents('frontend/homepage.html');
            break;
        }
        case "login": {
            echo file_get_contents('frontend/login.html');
            break;
        }
        default:
            header('Location: /login');
    }
}

if(session_start()) {
    $uri = SuperHelper::getPath();
    $method = $_SERVER['REQUEST_METHOD'];
    if (sizeof($uri) == 2 && $uri[0] == "api") {
        echo APIController::handle($_SERVER);
    } else if(sizeof($uri) == 1) {
        resolveRoutings($uri);
    } else {
        header('Location: /login');
        //die(); Enables Session hijacking http://thedailywtf.com/articles/WellIntentioned-Destruction
    }
} else {
    echo "Sorry, unable to create session :(";
}
?>


<!-- 1337 c0d3 -->

<?php
include 'includes/footer.php';
?>
