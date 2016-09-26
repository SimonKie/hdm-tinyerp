<?php
/**
 * Created by PhpStorm.
 * User: Heike
 * Date: 26.09.2016
 * Time: 14:05
 */
require_once('includes/bootstrap.inc.php');

User::checkLogin();

$content = "<h2>Firma</h2>";

// Set the Step var
if(isset($_GET['id']))
    $id = $_GET['id'];
else
    $id = '';

if($id == '1')
{
    // Update company Form
    $company = CompanyMapper::findbyid(intval($_GET['companyid']));

    $content .= Company::getForm($company);

} else if($id == '2') {

    // Process the Company post data by calling the formMapper

    $company = Company::formMapper($_POST);

    if ($company instanceof Company) {
        // If the Mapper passed correctly, the data will be given to database
        if ($_POST['action'] == 'update') {
            CompanyMapper::update($company);
            $content .= "<div class='alert alert-success'> <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a><p>Firma erfolgreich ge&auml;ndert.</p></div>";
        } else {
            CompanyMapper::add($company);
            $content .= "<div class=\'alert alert-success'><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a><p>Firma erfolgreich eingef&uuml;gt.</p></div>";
        }

$content .= Company::getTable(CompanyMapper::getAllCompanies());
    }

    else {
        // The formMapper failed
        $content .= $company;
    }
} else if($id == '3') {
    // The add new Company form is called
    $content .= "<h6>Neue Firma</h6>";
    $content .= Company::getForm();
} else if($id == '4')
{
    // Delete Company is called

    if(empty($_GET['sure']))
    {
        // ask the User if he is sure

        $content .= "<div class=\"alert alert-warning\"><p>Wirklich l&ouml;schen?</p>
                     <p><button class='btn update' onclick=\"window.location.href='?id=4&companyid=" . $_GET['companyid'] . "&sure=true'\">Ja</button>
                     <button class='btn delete' onclick=\"window.location.href='?'\">Nein</button></p>
                     </div>";

        $content .= Company::getTable(CompanyMapper::getAllCompanies());

    } else {
        // If the user is sure, delete the Company in database

        $company = new Company();
        $company->setId(intval($_GET['companyid']));
        CompanyMapper::delete($company);
        $content .= "<div class=\"alert alert-success\">
  <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
  Datensatz erfolgreich gelöscht.
</div>";
        $content .= Company::getTable(CompanyMapper::getAllCompanies());
    }

} else {

    // show the Company table
    $content .= Company::getTable(CompanyMapper::getAllCompanies());
}


// Initialize Page
$page = new Page();
$page->setTitle("tinyERP - Company");
$page->setRightArea($page->getMasterDataNav());
$page->setContent($content);

$page->run();
