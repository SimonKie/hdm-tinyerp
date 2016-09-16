<?php
/**
 * Created by PhpStorm.
 * User: Daniel
 * Date: 23.08.2016
 * Time: 09:49
 */


require_once('includes/bootstrap.inc.php');

User::checkLogin();

$content = "<h3>Steuersätze</h3>";

if(isset($_GET['id']))
    $id = $_GET['id'];
else
    $id = '';

if($id == '1')
{
    $VAT = VatMapper::findById(intval($_GET['vatid']));

    $content .= VAT::getForm($VAT);

} else if($id == '2') {

    $VAT = VAT::formMapper($_POST);

    if ($VAT instanceof VAT) {
        if ($_POST['action'] == 'update') {
            VatMapper::update($VAT);
        } else {
            VatMapper::add($VAT);
        }

        $content .= "Datensatz erfolgreich eingefügt.";
        $content .= VAT::getTable(VatMapper::getAllVats());

    }
    else {
        $content .= $VAT;
    }
} else if($id == '3') {
    $content .= "<h6>Neuer Mehrwertsteuersatz</h6>";
    $content .= VAT::getForm();
} else if($id == '4')
{
    if(empty($_GET['sure']))
    {
        $content .= "Wirklich löschen?
                     <button onclick=\"window.location.href='?id=4&vatid=" . $_GET['vatid'] . "&sure=true'\">Ja</button>
                     <button onclick=\"window.location.href='?'\">Nein</button>";
        $content .= VAT::getTable(VatMapper::getAllVats());
    } else {
        $VAT = new VAT();
        $VAT->setId(intval($_GET['vatid']));
        VatMapper::delete($VAT);
        $content .= "Datensatz wurde gelöscht.";
        $content .= VAT::getTable(VatMapper::getAllVats());
    }

} else {

    $content .= VAT::getTable(VatMapper::getAllVats());
}

$page = new Page();
$page->setTitle("tinyERP - VAT");
$page->setRightArea($page->getMasterDataNav());
$page->setContent($content);

$page->run();
