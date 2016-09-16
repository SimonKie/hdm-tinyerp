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
            $content .= User::getLoginForm("Falscher Benutzername oder Passwort!");

        } else
        {
            $_SESSION['USER'] = serialize($User);
            Header('Location: index.php');

        }

    } else if(isset($_SESSION['USER'])) {

        // did we just set a cookie? cool, back to index.php
        Header('Location: index.php');

    } else {
        $content .= User::getLoginForm();
    }


$page = new Page();
$page->setTitle("tinyERP - Login");
$page->setContent($content);

$page->run();

