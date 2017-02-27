<?php
/**
 * Created by PhpStorm.
 * User: Elli
 * Date: 9/26/2016
 * Time: 1:52 PM
 */


require_once('includes/bootstrap.inc.php');

// check if user is logged in
User::checkLogin();


$content = "<h2>Kunden</h2>";


// Set the Step var
if(isset($_GET['id']))
    $id = $_GET['id'];
else
    $id = '';

if($id == '1')
{
    // Update customer Form
    $customer = CustomerMapper::findById(intval($_GET['customerid']));

    $content .= Customer::getForm($customer);

} else if($id == '2') {

    // Process the customer post data by calling the formMapper

    $customer = Customer::formMapper($_POST);

    if ($customer instanceof Customer) {
        // If the Mapper passed correctly, the data will be given to database
        if ($_POST['action'] == 'update') {
            CustomerMapper::update($customer);
            $content .= "<div class='alert alert-success'> <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a><p>Kunde erfolgreich ge&auml;ndert.</p></div>";

        } else {
            CustomerMapper::add($customer);
            $content .= "<div class=\'alert alert-success'><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a><p>Kunde erfolgreich eingef&uuml;gt.</p></div>";

        }

        $content .= Customer::getTable(CustomerMapper::getAllCustomers());

    }
    else {
        // The formMapper failed
        $content .= $customer;
    }
} else if($id == '3') {
    // The add new customer form is called
    $content .= "<h3>Neuer Kunde</h3>";
    $content .= Customer::getForm();
} else if($id == '4')
{
    // Delete customer is called

    if(empty($_GET['sure']))
    {
        // ask the customer if he is sure

        $content .= "<div class=\"alert alert-warning\"><p>Wirklich l&ouml;schen?</p>
                     <p><button class='btn update' onclick=\"window.location.href='?id=4&customerid=" . $_GET['customerid'] . "&sure=true'\">Ja</button>
                     <button class='btn delete' onclick=\"window.location.href='?'\">Nein</button></p>
                     </div>";

        $content .= Customer::getTable(CustomerMapper::getAllCustomers());

    } else {
        // If the user is sure, delete the customer in database

        $customer = new Customer();
        $customer->setId(intval($_GET['customerid']));
        CustomerMapper::delete($customer);
        $content .= "<div class=\"alert alert-success\">
  <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
  Datensatz erfolgreich gelöscht.
</div>";
        $content .= Customer::getTable(CustomerMapper::getAllCustomers());
    }

} else {

    // show the customers table
    $content .= Customer::getTable(CustomerMapper::getAllCustomers());
}


// Initialize Page
$page = new Page();
$page->setTitle("tinyERP - Customer");
$page->setRightArea($page->getMasterDataNav());
$page->setContent($content);

$page->run();

