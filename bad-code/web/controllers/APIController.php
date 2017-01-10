<?php
/**
 * @author Christoph Ulshoefer <christophsulshoefer@gmail.com>
 * @copyright 2017
 * @license http://opensource.org/licenses/gpl-license.php MIT License
 */

namespace BYOG\Controllers;
require_once('components/SnippetAPI.php');
require_once('components/SettingsAPI.php');
require_once('components/SuperHelper.php');
use BYOG\Components\SnippetAPI;
use BYOG\Components\SettingsAPI;
use BYOG\Components\SuperHelper;

/**
 * Class APIController
 *
 * @package BYOG\Controllers
 * @author Christoph Ulshoefer <christophsulshoefer@gmail.com>
 * @version 0.0.1
 */
class APIController
{
    public static function handle($request) {
        $path = SuperHelper::getPath();
        switch ($path[1]) {
            case "snippets": {
                return SnippetAPI::handle($request);
                break;
            }
            case "settings": {
                return SettingsAPI::handle($request);
                break;
            }
            default: {
                SuperHelper::give404();
            }
        }
    }
}
