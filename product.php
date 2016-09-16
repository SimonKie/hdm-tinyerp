<?php
/**
 * Created by PhpStorm.
 * User: Daniel
 * Date: 24.08.2016
 * Time: 16:58
 */

require_once('includes/bootstrap.inc.php');


$content = ProductCategory::getDropdown(ProductCategoryMapper::getAllProductCategories());

$content .= "";

$page = new Page();
$page->setTitle("tinyERP - Produktverwaltung");
$page->setContent($content);
$page->run();
