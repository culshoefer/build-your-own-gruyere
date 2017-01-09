<?php
namespace BYOG;

require_once('components/SuperHelper.php');
require_once('controllers/APIController.php');
use BYOG\Controllers\APIController;
use BYOG\Components\SuperHelper;

#include 'includes/header.php';

$uri = SuperHelper::getPath();
$method = $_SERVER['REQUEST_METHOD'];
if (sizeof($uri) == 2 && $uri[0] == "api") {
    echo APIController::handle($_SERVER);
} else if(sizeof($uri) == 1) {
    switch($uri[0]) {
        case "login": {
            echo file_get_contents('frontend/login.html');
            break;
        }
        case "settings": {
            echo file_get_contents('frontend/settings.html');
            break;
        }
        default: echo file_get_contents('frontend/homepage.html');
    }
} else {
    echo file_get_contents('frontend/login.html');
}
?>


<!-- 1337 c0d3 -->

<?php
include 'includes/footer.php';
?>
