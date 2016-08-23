<?php
/**
 * Created by PhpStorm.
 * User: Daniel
 * Date: 23.08.2016
 * Time: 09:49
 */

require_once('includes/classes/vat.inc.php');
require_once('includes/mysql.inc.php');
require_once('includes/page.inc.php');



$vats = VATMapper::getallVATs();

$content = "";

foreach($vats as $vat) {
    $content .= $vat->listObject();
}

$page = new Page();
$page->setTitle("tinyERP - VAT");
$page->setContent($content);
$page->run();