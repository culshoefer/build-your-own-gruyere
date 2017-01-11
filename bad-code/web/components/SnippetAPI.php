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
    public static function handle($request)
    {
        $m = $_SERVER['REQUEST_METHOD'];
        if ($m === 'GET') {
            if (!isset($_GET['user_id'])) {
                SuperHelper::give400();
                die('`user_id` is not specified!');
            }
            $conn = SuperHelper::getDbConnection();
            $res = mysqli_query($conn,
                "SELECT * FROM snippets WHERE owner_id = '" . $_GET['user_id'] . "'");
            SuperHelper::jsonHeader();
            $results_array = array();
            while ($row = mysqli_fetch_assoc($res)) {
                $results_array[] = $row;
            }
            echo json_encode($results_array);
        }

        if ($m === 'DELETE') {
            if (!isset($_POST['snippet_id'])) {
                SuperHelper::give400();
                die('`snippet_id` is not specified!');
            }
            $conn = SuperHelper::getDbConnection();
            $res = mysqli_query($conn,
                "DELETE FROM snippets WHERE id = '" . $_POST['snippet_id'] . "'");
            if(!$res) {
                echo json_decode('');
                return;
            }
            echo json_encode(array());
        }
    }

}
