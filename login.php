<?php
/**
 * Created by PhpStorm.
 * User: Simon
 * Date: 22.08.2016
 * Time: 20:31
 */

    require_once('includes/classes/html.inc.php');
    $html = new HTML();

    session_start();

    // do both fields contain information?
    if(isset($_POST['username']) && isset($_POST['password'])) {
        // TODO check if the credentials are correct, if yes set $_SESSION['user-id']
        if(false) {
            $_SESSION['user-id'] = 1;
        } else {
            // TODO output form with error 'please enter correct username and password'
        }
    }

    else if(isset($_POST['username'])) {
        // TODO output form with error 'please enter password'
    }

    else if(isset($_POST['password'])) {
        // TODO output form with error 'please enter username'
    }

    // did we just set a cookie? cool, back to index.php
    if(isset($_SESSION['user-id'])) {
        Header('Location: index.php');
        exit;
    } else {

        // output standard form without modifications
        echo $html->header("TinyERP :: Login");
        echo $html->topbar(false,"");
        echo $html->startLoginForm();
        echo "<h2>Login</h2>";
        echo "<form method=\"post\" action=\"login.php\" class=\"form-group\">";
        echo "<input class=\"form-control\" type=\"text\" name=\"username\" placeholder=\"Benutzername\"/>";
        echo "<input class=\"form-control\" type=\"password\" name=\"password\" placeholder=\"Passwort\"/>";
        echo "<button type=\"submit\" class=\"btn btn-primary\">Anmelden</button>";
        echo "</form>";
        echo $html->endLoginForm();
        echo $html->footer();


    }