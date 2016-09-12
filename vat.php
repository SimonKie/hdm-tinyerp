<?php
/**
 * Created by PhpStorm.
 * User: Daniel
 * Date: 23.08.2016
 * Time: 09:49
 */


require_once('includes/bootstrap.inc.php');

$content = "";

if(isset($_GET['id']))
    $id = $_GET['id'];
else
    $id = '';

if($id)
{
    $content .= "<h6>Mehrwertsteuersatz ändern</h6>";
    $VAT = VatMapper::findById(intval($_GET['vatid']));

    $content .= VAT::getForm($VAT);

} else if($id) {

    $VAT = VAT::formMapper($_POST);

    if ($VAT instanceof VAT) {
        if ($_POST['action'] == 'update')
            VatMapper::update($VAT);
        else
            VatMapper::add($VAT);

        $content .= "Datensatz erfolgreich eingefügt.";
    }
    else {
        $content .= $VAT;
    }
} else {
    $content .= "<h6>Neuer Mehrwertsteuersatz</h6>";
    $content .= VAT::getForm();
}

$page = new Page();
$page->setTitle("tinyERP - VAT");
$page->setRightArea($page->getMasterDataNav());
$page->setContent($content);

$page->run();