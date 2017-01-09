<?php
/**
 * @author Christoph Ulshoefer <christophsulshoefer@gmail.com>
 * @copyright 2017
 * @license http://opensource.org/licenses/gpl-license.php MIT License
 */

namespace BYOG\Controllers;


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
        if($request['REQUEST_METHOD'] == "GET") {
            return self::getSettings($request);
        } else if($request['REQUEST_METHOD'] == "POST") {
            return self::postSettings($request);
        }
    }

    private static function getSettings($request)
    {
        return file_get_contents('../expecteddocuments/bad/settings.json');
    }

    private static function postSettings($request)
    {
        return null;
    }
}