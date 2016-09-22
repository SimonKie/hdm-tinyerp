<?php
/**
 * Created by PhpStorm.
 * User: Daniel
 * Date: 23.08.2016
 * Time: 09:49
 */


require_once('includes/bootstrap.inc.php');

User::checkLogin();


$content = "<h3>Steuers&auml;tze</h3>";


// Set the Step var
if(isset($_GET['id']))
    $id = $_GET['id'];
else
    $id = '';

if($id == '1')
{
    // Update VAT Form
    $VAT = VatMapper::findById(intval($_GET['vatid']));

    $content .= VAT::getForm($VAT);

} else if($id == '2') {

    // Process the VAT post data by calling the formMapper

    $VAT = VAT::formMapper($_POST);

    if ($VAT instanceof VAT) {
        // If the Mapper passed correctly, the data will be given to database
        if ($_POST['action'] == 'update') {
            VatMapper::update($VAT);
        } else {
            VatMapper::add($VAT);
        }


        $content .= "Datensatz erfolgreich eingef&uuml;gt.";
        $content .= VAT::getTable(VatMapper::getAllVats());

    }
    else {
        // The formMapper failed
        $content .= $VAT;
    }
} else if($id == '3') {
    // The add new VAT form is called
    $content .= "<h6>Neuer Mehrwertsteuersatz</h6>";
    $content .= VAT::getForm();
} else if($id == '4')
{
    // Delete VAT is called

    if(empty($_GET['sure']))
    {
        // ask the User if he is sure

        $content .= "Wirklich l&ouml;schen?
                     <button onclick=\"window.location.href='?id=4&vatid=" . $_GET['vatid'] . "&sure=true'\">Ja</button>
                     <button onclick=\"window.location.href='?'\">Nein</button>";
        $content .= VAT::getTable(VatMapper::getAllVats());

    } else {
        // If the user is sure, delete the VAT in database

        $VAT = new VAT();
        $VAT->setId(intval($_GET['vatid']));
        VatMapper::delete($VAT);
        $content .= "Datensatz wurde gel&ouml;scht.";
        $content .= VAT::getTable(VatMapper::getAllVats());
    }

} else {

    // show the VAT table
    $content .= VAT::getTable(VatMapper::getAllVats());
}


// Initialize Page
$page = new Page();
$page->setTitle("tinyERP - VAT");
$page->setRightArea($page->getMasterDataNav());
$page->setContent($content);

$page->run();
