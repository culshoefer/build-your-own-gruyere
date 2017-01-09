<?php
/**
 * @author Christoph Ulshoefer <christophsulshoefer@gmail.com>
 * @copyright 2017
 * @license http://opensource.org/licenses/gpl-license.php MIT License
 */

namespace BYOG\Components;


/**
 * Class Helper
 *
 * @package BYOG\Controllers
 * @author Christoph Ulshoefer <christophsulshoefer@gmail.com>
 * @version 0.0.1
 */
class SuperHelper
{
    public static function getPath() {
        return explode('/', trim($_SERVER['REQUEST_URI'],'/'));
    }

    public static function redirectoTo($location) {
        header('Location: ' . $location);
        //die(); Enables Session hijacking http://thedailywtf.com/articles/WellIntentioned-Destruction
    }

    public static function give404() {
        header("HTTP/1.0 404 Not Found");
        self::redirectoTo('/login');
    }
}
