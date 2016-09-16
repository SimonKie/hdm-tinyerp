<?php
/**
 * Created by PhpStorm.
 * User: Daniel
 * Date: 23.08.2016
 * Time: 09:49
 */


require_once('includes/bootstrap.inc.php');

User::checkLogin();

$content = "<h3>Home</h3>";


$page = new Page();
$page->setTitle("tinyERP - Home");

$page->setContent($content);

$page->run();
