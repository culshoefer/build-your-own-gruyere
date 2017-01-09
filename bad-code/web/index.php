<?php
namespace BYOG;
require_once('controllers/SnippetAPI.php');
require_once('controllers/SettingsAPI.php');
use BYOG\Controllers\SnippetAPI;
use BYOG\Controllers\SettingsAPI;

#include 'includes/header.php';

$uri = explode('/', trim($_SERVER['REQUEST_URI'],'/'));
$method = $_SERVER['REQUEST_METHOD'];
if (sizeof($uri) == 1) {
    switch ($uri[0]) {
        case "snippets": {
            $ret = SnippetAPI::handle($_SERVER);
            echo $ret;
            break;
        }
        case "settings": {
            echo "settings";
            echo SettingsAPI::handle($_SERVER);
            break;
        }
        default: {
            echo file_get_contents('frontend/homepage.html');
        }
    }
} else {
    echo file_get_contents('frontend/homepage.html');
}
?>


<!-- 1337 c0d3 -->

<?php
include 'includes/footer.php';
?>
