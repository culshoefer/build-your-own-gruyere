<?php
/**
 * @author Christoph Ulshoefer <christophsulshoefer@gmail.com>
 * @copyright 2017
 * @license http://opensource.org/licenses/gpl-license.php MIT License
 */

namespace BYOG\Components;
use mysqli;


/**
 * Class Registration
 * Contains all the registration logic
 * @package BYOG\Components
 * @author Christoph Ulshoefer <christophsulshoefer@gmail.com>
 * @version 0.0.1
 */
class Registration
{


    /**
     * @param $username
     * @return void|int nothing or user_id
     */
    private static function userExists($username) {
        $conn = SuperHelper::getDbConnection();
        if($conn->connect_error) {
            echo "Error connecting to database!";
            return false;
        } else {
            $res = $conn->query("SELECT * FROM users WHERE name = '" . $username . "'");
            var_dump($res);
            return count($res) > 0;
        }
    }

    public static function registerUser($username, $password) {
        if(!empty($username) && !self::userExists($username)) {
            //do db query
            //INSERT INTO `users` (`username`, `password`) VALUES (
        }
    }
}
