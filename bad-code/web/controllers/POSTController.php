<?php
/**
 * @author Christoph Ulshoefer <christophsulshoefer@gmail.com>
 * @copyright 2017
 * @license http://opensource.org/licenses/gpl-license.php MIT License
 */

namespace BYOG\Controllers;
use BYOG\Components\Login;
use BYOG\Components\SuperHelper;

/**
 * Class APIController
 *
 * @package BYOG\Controllers
 * @author Christoph Ulshoefer <christophsulshoefer@gmail.com>
 * @version 0.0.1
 */
class POSTController
{
    public static function handle($request) {
        $path = SuperHelper::getPath();

        if(!Login::isLoggedIn()) {
            return SuperHelper::giveForbidden();
        }

        $m = $_SERVER['REQUEST_METHOD'];

        switch ($path[1]) {
            case "snippets": {
                if($m === 'GET') {
                    if(!isset($_POST['user_id'])) {
                        return SuperHelper::give400();
                    }
                    $conn = SuperHelper::getDbConnection();
                    $res = mysqli_query($conn,
                        "SELECT * FROM snippets WHERE owner_id = " . $_POST['user_id']);
                    echo json_encode($res);
                }
                break;
            }
            case "settings": {
                return SettingsAPI::handle($request);
                break;
            }
            default: {
                return SuperHelper::give404();
            }
        }
    }
}
