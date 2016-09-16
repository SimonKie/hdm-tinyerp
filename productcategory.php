<?php
/**
 * Created by PhpStorm.
 * User: Elli
 * Date: 9/16/2016
 * Time: 2:21 PM
 */

require_once('includes/bootstrap.inc.php');

$content= '<h3>Produktkategorien</h3>';


if(isset($_GET['id']))
    $id = $_GET['id'];
else
    $id = '';

if($id == '1')
{
    $productcategory = ProductCategoryMapper::findById(intval($_GET['productcategoryid']));

    $content .= ProductCategory::getForm($productcategory);

} else if($id == '2') {

    $productcategory = ProductCategory::formMapper($_POST);

    if ($productcategory instanceof ProductCategory) {
        if ($_POST['action'] == 'update') {
            ProductCategoryMapper::update($productcategory);
        } else {
            ProductCategoryMapper::add($productcategory);
        }

        $content .= "Produktkategorie erfolgreich erstellt.";
        $content .= ProductCategory::getTable(ProductCategoryMapper::getAllProductCategories());

    }
    else {
        $content .= $productcategory;
    }
} else if($id == '3') {
    $content .= "<h6>Neue Produktkategorie</h6>";
    $content .= ProductCategory::getForm();
} else if($id == '4')
{
    if(empty($_GET['sure']))
    {
        $content .= "Wirklich löschen?
                     <button onclick=\"window.location.href='?id=4&productcategoryid=" . $_GET['productcategoryid'] . "&sure=true'\">Ja</button>
                     <button onclick=\"window.location.href='?'\">Nein</button>";
        $content .= ProductCategory::getTable(ProductCategoryMapper::getAllProductCategories());
    } else {
        $productcategory = new ProductCategory();
        $productcategory->setId(intval($_GET['productcategoryid']));
        ProductCategoryMapper::delete($productcategory);
        $content .= "Produktkategorie wurde gelöscht.";
        $content .= ProductCategory::getTable(ProductCategoryMapper::getAllProductCategories());
    }
} else {
    $content .= ProductCategory::getTable(ProductCategoryMapper::getAllProductCategories());
}


$page = new Page();
$page->setTitle("tinyERP - Productcategory");
$page->setRightArea($page->getMasterDataNav());
$page->setContent($content);

$page->run();