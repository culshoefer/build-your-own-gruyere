<?php
namespace BYOG\Controllers;
use Exception;
/**
 * @author Christoph Ulshoefer <christophsulshoefer@gmail.com>
 * @copyright 2017
 * @license http://opensource.org/licenses/gpl-license.php MIT License
 */
class SnippetAPI
{
    public static function handle($request) {
        if($request['REQUEST_METHOD'] == "GET") {
            return self::getSnippets($request);
        } else if($request['REQUEST_METHOD'] == "POST") {
            return self::postSnippet($request);
        }
    }

    private static function getSnippets($request)
    {
        return file_get_contents('../expecteddocuments/bad/snippets.json');
    }

    private static function postSnippet($request)
    {
        return null;
    }
}
