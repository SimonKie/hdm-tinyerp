<?php
/**
 * Created by PhpStorm.
 * User: Elli
 * Date: 10/3/2016
 * Time: 2:07 PM
 */


require_once('includes/bootstrap.inc.php');

User::checkLogin();


$content = "<h2>Mitarbeiter</h2>";


// Set the Step var
if(isset($_GET['id']))
    $id = $_GET['id'];
else
    $id = '';

if($id == '1')
{
    // Update employee Form
    $employee = EmployeeMapper::findById(intval($_GET['employeeid']));

    $content .= Employee::getForm($employee);

} else if($id == '2') {

    // Process the employee post data by calling the formMapper

    $employee = Employee::formMapper($_POST);

    if ($employee instanceof Employee) {
        // If the Mapper passed correctly, the data will be given to database
        if ($_POST['action'] == 'update') {
            EmployeeMapper::update($employee);
            $content .= "<div class='alert alert-success'> <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a><p>Mitarbeiter erfolgreich ge&auml;ndert.</p></div>";

        } else {
            EmployeeMapper::add($employee);
            $content .= "<div class=\'alert alert-success'><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a><p>Mitarbeiter erfolgreich eingef&uuml;gt.</p></div>";

        }

        $content .= Employee::getTable(EmployeeMapper::getAllEmployees());

    }
    else {
        // The formMapper failed
        $content .= $employee;
    }
} else if($id == '3') {
    // The add new customer form is called
    $content .= "<h3>Neuer Mitarbeiter</h3>";
    $content .= Employee::getForm();
} else if($id == '4')
{
    // Delete customer is called

    if(empty($_GET['sure']))
    {
        // ask the customer if he is sure

        $content .= "<div class=\"alert alert-warning\"><p>Wirklich l&ouml;schen?</p>
                     <p><button class='btn update' onclick=\"window.location.href='?id=4&employeeid=" . $_GET['employeeid'] . "&sure=true'\">Ja</button>
                     <button class='btn delete' onclick=\"window.location.href='?'\">Nein</button></p>
                     </div>";

        $content .= Employee::getTable(EmployeeMapper::getAllEmployees());

    } else {
        // If the user is sure, delete the customer in database

        $employee = new Employee();
        $employee->setId(intval($_GET['employeeid']));
        EmployeeMapper::delete($employee);
        $content .= "<div class=\"alert alert-success\">
  <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
  Datensatz erfolgreich gelöscht.
</div>";
        $content .= Employee::getTable(EmployeeMapper::getAllEmployees());
    }

} else {

    // show the customers table
    $content .= Employee::getTable(EmployeeMapper::getAllEmployees());
}


// Initialize Page
$page = new Page();
$page->setTitle("tinyERP - Customer");
$page->setRightArea($page->getMasterDataNav());
$page->setContent($content);

$page->run();

