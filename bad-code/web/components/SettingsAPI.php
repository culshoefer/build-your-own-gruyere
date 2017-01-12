<?php
/**
 * @author Christoph Ulshoefer <christophsulshoefer@gmail.com>
 * @copyright 2017
 * @license http://opensource.org/licenses/gpl-license.php MIT License
 */

namespace BYOG\Components;


/**
 * Class SettingsAPI
 *
 * @package BYOG\Components
 * @author Christoph Ulshoefer <christophsulshoefer@gmail.com>
 * @version 0.0.1
 */
class SettingsAPI
{
    public static function handle($request) {
        $m = $_SERVER['REQUEST_METHOD'];
        if ($m === 'GET') {
            if (!isset($_GET['user_id'])) {
                SuperHelper::give400();
                die('`user_id` is not specified!');
            }
            $conn = SuperHelper::getDbConnection();
            $userRes = mysqli_query($conn,
                "SELECT * FROM users WHERE id = '" . $_GET['user_id'] . "'");
            $settingsRes = mysqli_query($conn,
                "SELECT * FROM settings WHERE user_id = '" . $_GET['user_id'] . "'");
            SuperHelper::jsonHeader();
            $results_array = array();
            $user_array = mysqli_fetch_assoc($userRes);
            $settubgs_array = mysqli_fetch_assoc($settingsRes);
            $results_array['username'] = $user_array['name'];
            $results_array['password'] = $user_array['password'];
            $results_array['avatarurl'] = $settubgs_array['icon_url'];
            $results_array['privatesnippet'] = $settubgs_array['private_snippet'];
            $results_array['homepageurl'] = $settubgs_array['home_url'];
            $results_array['profilecolour'] = $settubgs_array['colour'];
            echo json_encode($results_array);
        }

        if ($m === 'POST') {
            if (!isset($_GET['user_id'])
                || !isset($_GET['username'])
                || !isset($_GET['password'])
                || !isset($_GET['avatarurl'])
                || !isset($_GET['privatesnippet'])
                || !isset($_GET['homepageurl'])
                || !isset($_GET['profilecolour'])) {
                SuperHelper::give400();
                die('Some of the settings are not specified!');
            }
            $conn = SuperHelper::getDbConnection();
            $userRes = mysqli_query($conn,
                "UPDATE users SET name='$_GET[username]', password='$_GET[password]' WHERE id = $_GET[user_id]");
            $settingsRes = mysqli_query($conn,
                "UPDATE settings SET icon_url='$_GET[avatarurl]', private_snippet='$_GET[privatesnippet]', home_url='$_GET[homepageurl]', colour='$_GET[profilecolour]' WHERE user_id = $_GET[user_id]");
            if (!$userRes || !$settingsRes) {
                echo json_decode('');
                return;
            }
            echo json_encode(array());
        }
    }
}