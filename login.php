<?php
/**
 * Created by PhpStorm.
 * User: Simon
 * Date: 22.08.2016
 * Time: 20:31
 */

    require_once('includes/bootstrap.inc.php');

    $content = "";

    if(!FORCE_LOGIN)
    {
        // If login is disabled, then the user will be redirected to index.php
        Header('Location: index.php');
    } else if(isset($_GET['logout'])) {

        // Check if logout is happening
        session_destroy();
        $content .= User::getLoginForm("Erfolgreich abgemeldet!");


    } else if(isset($_POST['username']) && isset($_POST['password'])) {

        // Check if login.php is called by form

        $User = UserMapper::login($_POST['username'], $_POST['password']);

        if($User == null)
        {
            // Login failed
            $content .= User::getLoginForm("Falscher Benutzername oder Passwort!");

        } else
        {
            // Login was correct, the user object is given to SESSION var.
            $_SESSION['USER'] = serialize($User);
            Header('Location: index.php');
        }

    } else if(isset($_SESSION['USER'])) {

        // did we just set a cookie? cool, back to index.php
        Header('Location: index.php');

    } else {
        // Nothing happended, the Login form will be shown to the user
        $content .= User::getLoginForm();
    }


// Initialize Page
$page = new Page();
$page->setTitle("tinyERP - Login");
$page->setContent($content);

$page->run();

