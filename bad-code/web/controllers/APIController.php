<?php
/**
 * @author Timur Kuzhagaliyev <tim.kuzh@gmail.com>
 * @copyright 2017
 * @license http://opensource.org/licenses/gpl-license.php MIT License
 */

namespace BYOG\Controllers;

use BYOG\Components\Login;
use BYOG\Components\SettingsAPI;
use BYOG\Components\SnippetAPI;
use BYOG\Components\SuperHelper;

/**
 * Class APIController
 *
 * @package BYOG\Controllers
 * @author Timur Kuzhagaliyev <tim.kuzh@gmail.com>
 * @version 0.0.1
 */
class APIController
{
    public static function handle($request)
    {
        if(count($request) < 2) {
            SuperHelper::give400();
            die();
        }

        if($request[1] === 'overview') {
            $conn = SuperHelper::getDbConnection();
            $res = mysqli_query($conn,
                "SELECT * FROM users JOIN settings");
            SuperHelper::jsonHeader();
            $results_array = array();
            while ($row = mysqli_fetch_assoc($res)) {
                $resRow = array();
                $resRow['username'] = $row['name'];
                $resRow['user_id'] = $row['id'];
                $resRow['homepageurl'] = $row['home_url'];
                $res2 = mysqli_query($conn,
                    "SELECT content FROM snippets WHERE owner_id = " . $row['id'] . " ORDER BY id DESC LIMIT 1");
                if(mysqli_num_rows($res2) === 1) {
                    $snipRes = mysqli_fetch_assoc($res2);
                    $resRow['last_snippet'] = $snipRes['content'];
                } else {
                    $resRow['last_snippet'] = null;
                }
                $results_array[] = $resRow;
            }
            echo json_encode($results_array);
            die();
        }
        switch ($request[1]) {
            case "snippets":
                SnippetAPI::handle($request);
                break;
            case "settings":
                SettingsAPI::handle($request);
                break;
            default:
                SuperHelper::give404();
                die();
        }
    }
}
