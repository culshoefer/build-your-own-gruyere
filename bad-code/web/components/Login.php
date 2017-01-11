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
    private static $user_id;

    private static function areValidCredentials()
    {
        $conn = SuperHelper::getDbConnection();
        $res = mysqli_query($conn,
            "SELECT id FROM users WHERE name = '" . $_POST['username'] . "' AND PASSWORD = '" . $_POST['password'] . "'");
        if (mysqli_num_rows($res) < 1) return false;
        $row = mysqli_fetch_row($res);
        self::$user_id = $row[0];
        return true;
    }

    private static function providesCredentials()
    {
        return !empty($_POST['username']) && !empty($_POST['password']);
    }

    public static function loggedIn()
    {
        return isset($_COOKIE['logged_in']) && isset($_COOKIE['username']) &&
            !empty($_COOKIE['logged_in']) && !empty($_COOKIE['username']);
    }

    public static function wantsToLogin()
    {
        return isset($_POST['submit-login']) && self::providesCredentials();
    }

    public static function attemptLogin()
    {
        if (self::areValidCredentials()) {
            setcookie('logged_in', true);
            setcookie('username', $_POST['username']);
            setcookie('user_id', self::$user_id);
        }
    }

    public static function wantsToRegister()
    {
        return isset($_POST['submit-registration']) && self::providesCredentials();
    }

    public static function logout()
    {
        setcookie('logged_in', null, 1);
        setcookie('username', null, 1);
    }
}
