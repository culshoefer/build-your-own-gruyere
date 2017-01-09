<?php
/**
 * @author Christoph Ulshoefer <christophsulshoefer@gmail.com>
 * @copyright 2017
 * @license http://opensource.org/licenses/gpl-license.php MIT License
 */

namespace BYOG\Components;


/**
 * Class Registration
 * Contains all the registration logic
 * @package BYOG\Components
 * @author Christoph Ulshoefer <christophsulshoefer@gmail.com>
 * @version 0.0.1
 */
class Registration
{


    /**
     * @param $username
     * @return void|int nothing or user_id
     */
    function userExists($username) {
        return true;
    }

    function registerUser($username, $password) {

    }
}