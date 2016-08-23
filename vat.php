<?php
/**
 * Created by PhpStorm.
 * User: Daniel
 * Date: 23.08.2016
 * Time: 09:49
 */

require_once('includes/classes/vat.inc.php');
require_once('includes/mysql.inc.php');

$vats = VATMapper::getallVATs();

foreach($vats as $vat) {
    echo $vat->listObject();
}