<?php
namespace BYOG\Components;
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
        $conn = SuperHelper::getDbConnection();
        $res = mysqli_query($conn, "SELECT id, content FROM snippets WHERE user_id = '" . $_GET['username'] . "'");
        return json_encode($res);
    }

    private static function postSnippet($request)
    {
        return null;
    }
}
