<?php

/**
 * Created by PhpStorm.
 * User: Daniel
 * Date: 18.08.2016
 * Time: 14:48
 */
class DBConnection
{
    private static $dsn = 'mysql:host=wp306.webpack.hosteurope.de;dbname=db1076019-tinyerp';
    private static $dbuser = 'db1076019-u';
    private static $dbpass = '';


    public static function getConnection()
    {
        try {
            $conn = new PDO(self::$dsn, self::$dbuser, self::$dbpass);
        } catch (PDOException $e)
        {
            echo $e->getMessage();
            $conn = FALSE;
        }

        return $conn;
    }
}