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
    private static function areValidCredentials() {
        $conn = SuperHelper::getDbConnection();
        $res = mysqli_query($conn,
            "SELECT id FROM users WHERE username = " . $_POST['username'] . " AND password = " . $_POST['password']);
        #echo var_dump($res);
        return count($res) > 0;
    }

    private static function providesCredentials()
    {
        return !empty($_POST['username']) && !empty($_POST['password']);
    }

    public static function loggedIn() {
        return isset($_COOKIE['logged_in']) && isset($_COOKIE['username']) &&
        !empty($_COOKIE['logged_in']) && !empty($_COOKIE['username']);
    }

    public static function wantsToLogin() {
        return isset($_POST['submit-login']) && self::providesCredentials();
    }

    public static function attemptLogin()
    {
        if (self::areValidCredentials()) {
            setcookie('logged_in', true);
            setcookie('username', $_POST['username']);
        }
    }

    public static function wantsToRegister() {
        return isset($_POST['submit-registration']) && self::providesCredentials();
    }

    public static function logout() {
        setcookie('logged_in', null, 1);
        setcookie('username', null, 1);
    }
}
