<?php
/**
 * @author Christoph Ulshoefer <christophsulshoefer@gmail.com>
 * @copyright 2017
 * @license http://opensource.org/licenses/gpl-license.php MIT License
 */

namespace BYOG\Components;

use finfo;

/**
 * Class Helper
 *
 * @package BYOG\Controllers
 * @author Christoph Ulshoefer <christophsulshoefer@gmail.com>
 * @version 0.0.1
 */
class SuperHelper
{
    public static function getPath()
    {
        $uri = @preg_replace('\\?.*?$', '', $_SERVER['REQUEST_URI']);
        return explode('/', strtolower(trim($uri, '/')));
    }

    public static function redirectoTo($location)
    {
        header('Location: ' . $location);
        die(); //Enables Session hijacking http://thedailywtf.com/articles/WellIntentioned-Destruction
    }

    public static function jsonHeader()
    {
        header('Content-type: application/json');
    }

    public static function give404()
    {
        header("HTTP/1.0 404 Not Found");
    }

    public static function give400()
    {
        header("HTTP/1.0 400 Bad Request");
    }

    public static function give403()
    {
        header("HTTP/1.0 403 Forbidden");
    }

    public static function give401()
    {
        header("HTTP/1.0 401 Unauthorized");
    }

    public static function getDbConnection()
    {
        $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT);
        if (empty($conn->connect_error)) {
            return $conn;
        } else {
            echo "No connection to db possible";
            die();
        }
    }

    public static function content_type($filename) {
        $result = new finfo();

        if (is_resource($result) === true) {
            return $result->file($filename, FILEINFO_MIME_TYPE);
        }

        return false;
    }
}
