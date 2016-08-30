<?php
/**
 * Created by PhpStorm.
 * User: Daniel
 * Date: 23.08.2016
 * Time: 09:49
 */



require_once('includes/bootstrap.inc.php');

$content = "MWSt. : " . VAT::getDropdown(VATMapper::getAllVats());

$page = new Page();
$page->setTitle("tinyERP - VAT");
$page->setRightArea($page->getMasterDataNav());
$page->setContent($content);
$page->run();