<?php
/**
 * Created by PhpStorm.
 * User: Daniel
 * Date: 23.08.2016
 * Time: 11:48
 */

    require_once('includes/classes/html.inc.php');
    require_once('includes/classes/employee.inc.php');

    $html = new HTML();
    $emp = new Employee();

    $emp->setFirstName("Maximilian");
    $emp->setLastName("Mustermann");
    $emp->setEMail("m.mustermann@hdm-stuttgart.de");


    echo $html->header("Rechnung");
    echo $html->topbar(true,$emp);
    echo $html->footer();