<?php
/**
 * @author Christoph Ulshoefer <christophsulshoefer@gmail.com>
 * @copyright 2017
 * @license http://opensource.org/licenses/gpl-license.php MIT License
 */

namespace BYOG\Components;


/**
 * Class Login
 *
 * @package BYOG\Components
 * @author Christoph Ulshoefer <christophsulshoefer@gmail.com>
 * @version 0.0.1
 */
class Login
{
    private static function areValidCredentials($user_id, $password) {
        return true;
    }

    private static function providesCredentials()
    {
        return true;//!empty($_POST['username']) && !empty($_POST['password'])
    }

    public static function isLoggedIn() {
        //return !empty($_SESSION['isloggedin']) && !empty($_SESSION['username']);
        return self::areValidCredentials(null, null);
    }

    public static function wantsToLogin() {
        return false;
    }

    public static function wantsToRegister() {
        return false;
    }
}