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
            "SELECT * FROM users WHERE username = " . $_POST['username'] . " AND password = " . $_POST['password']);
        #echo var_dump($res);
        return count($res) > 0;
    }

    private static function providesCredentials()
    {
        return !empty($_POST['username']) && !empty($_POST['password']);
    }

    public static function isLoggedIn() {
        return isset($_SESSION['isloggeedin']) && isset($_SESSION['username']) &&
        !empty($_SESSION['isloggedin']) && !empty($_SESSION['username']);
        //return self::areValidCredentials(null, null);
    }

    public static function wantsToLogin() {
        return isset($_POST['submit-login']) && self::providesCredentials();
    }

    public static function attemptLogin() {
        if(self::areValidCredentials()) {
            $_SESSION['isloggedin'] = true;
            $_SESSION['username'] = $_POST['username'];
        }
    }

    public static function wantsToRegister() {
        return isset($_POST['submit-registration']) && self::providesCredentials();
    }

    public static function logout() {
        session_destroy();
    }
}
