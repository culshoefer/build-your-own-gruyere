<?php
/**
 * Created by PhpStorm.
 * User: timbokz
 * Date: 10/01/17
 * Time: 15:34
 */

namespace BYOG\Components;


class View
{

    public static function render($viewName)
    {
        include_once __DIR__ . '../views/' . $viewName;
    }

}