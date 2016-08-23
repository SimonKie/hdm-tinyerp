<?php
/**
 * Created by PhpStorm.
 * User: Daniel
 * Date: 23.08.2016
 * Time: 11:28
 */

/**
 * Import all mapper classes an config file
 */
require_once('mapper/DataMapper.php');
require_once('mapper/VATMapper.php');
require_once('Config.php');


/**
 * Trying to connect to MySQL database
 */
try {
    DataMapper::init(new PDO('mysql:host=' . DB_Host . ';dbname=' . DB_Name,DB_User, DB_Password));
} catch (Exception $e)
{
    echo $e->getMessage();
    die();
}
