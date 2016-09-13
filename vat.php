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

if($id == '1')
{
    $content .= "<h6>Mehrwertsteuersatz ändern</h6>";
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
    }
    else {
        $content .= $VAT;
    }
} else if($id == '3') {
    $content .= "<h6>Neuer Mehrwertsteuersatz</h6>";
    $content .= VAT::getForm();
} else if($id == '4')
{
    $VAT = new VAT();
    $VAT->setId(intval($_GET['vatid']));
    VatMapper::delete($VAT);
    $content .= "Datensatz wurde gelöscht.";
} else {
    $VATs = VatMapper::getAllVats();

    $content .= "<h6>Mehrwertsteuersätze</h6>
                 <button onclick=\"window.location.href='?id=3'\">Neuer Steuersatz</button>
                 <table border=\"1\">
                  <tr>
                    <th>ID</th>
                    <th>Steuersatz</th>
                    <th>Beschreibung</th>
                    <th>Start Datum</th>
                    <th>End Datum</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                   </tr>
                ";

    foreach ($VATs as $vat)
    {
        $content .= "
                        <tr>
                         <td>" . $vat->getId() . "</td>
                         <td>" . $vat->getValue() . "</td>
                         <td>" . $vat->getDescription() . "</td>
                         <td>" . $vat->getStartDate()->format('d.m.Y') . "</td>
                         <td>" . $vat->getEndDate()->format('d.m.Y') . "</td>
                         <td><button onclick=\"window.location.href='?id=1&vatid=" . $vat->getId() . "'\">ändern</button></td>
                         <td><button onclick=\"window.location.href='?id=4&vatid=" . $vat->getId() . "'\">löschen</button></td>
                        </tr>
        ";
    }

    $content .= "</table>";

}

$page = new Page();
$page->setTitle("tinyERP - VAT");
$page->setRightArea($page->getMasterDataNav());
$page->setContent($content);

$page->run();
