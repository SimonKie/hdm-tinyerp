<?php

/**
 * Created by PhpStorm.
 * User: Daniel
 * Date: 18.08.2016
 * Time: 14:48
 */

class DataMapper
{
    public static $db;

    public static function init ($db)
    {
        self::$db = $db;
    }
}