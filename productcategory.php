<?php
/**
 * Created by PhpStorm.
 * User: Elli
 * Date: 9/16/2016
 * Time: 2:21 PM
 */

require_once('includes/bootstrap.inc.php');
User::checkLogin();

$content= '<h2>Produktkategorien</h2>';


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
            $content .= "<div class='alert alert-success'> <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a><p>Produktkategorie erfolgreich ge&auml;ndert.</p></div>";
        } else {
            ProductCategoryMapper::add($productcategory);
            $content .= "<div class='alert alert-success'> <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a><p>Produktkategorie erfolgreich erstellt.</p></div>";
        }

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
        $content .= "<div class='alert alert-warning'><p>Wirklich l&ouml;schen?</p>
                     <p><button class='btn update' onclick=\"window.location.href='?id=4&productcategoryid=" . $_GET['productcategoryid'] . "&sure=true'\">Ja</button>
                     <button class='btn delete' onclick=\"window.location.href='?'\">Nein</button></p></div>";
        $content .= ProductCategory::getTable(ProductCategoryMapper::getAllProductCategories());
    } else {
        $productcategory = new ProductCategory();
        $productcategory->setId(intval($_GET['productcategoryid']));
        ProductCategoryMapper::delete($productcategory);
        $content .= "<div class='alert alert-success'> <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a><p>Produktkategorie wurde erfolgreich gel&ouml;scht.</p></div>";
        $content .= ProductCategory::getTable(ProductCategoryMapper::getAllProductCategories());
    }
} else {
    $content .= ProductCategory::getTable(ProductCategoryMapper::getAllProductCategories());
}


$page = new Page();
$page->setTitle("tinyERP - Produkkategorie");
$page->setRightArea($page->getMasterDataNav());
$page->setContent($content);

$page->run();