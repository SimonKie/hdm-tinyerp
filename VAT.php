<?php
/**
 * Created by PhpStorm.
 * User: Daniel
 * Date: 23.08.2016
 * Time: 09:49
 */

require_once('includes/classes/VAT.php');
require_once('includes/MySQL.php');

$vats = VATMapper::getallVATs();

foreach($vats as $vat) {
    echo $vat->listObject();
}