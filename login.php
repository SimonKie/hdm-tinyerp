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

    // Check if logout is happening
    if(isset($_GET['logout'])) {

        echo $html->header("TinyERP :: Login");
        echo $html->topbar(false,"");
        echo $html->startLoginForm();

        echo "<h2>TinyERP - Login</h2>";
        echo "<div class=\"alert alert-success fade in\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>Erfolgreich abgemeldet.</div>";
        echo "<form method=\"post\" action=\"login.php\" class=\"form-group\">";
        echo "<input class=\"form-control\" type=\"text\" name=\"username\" placeholder=\"Benutzername\"/>";
        echo "<input class=\"form-control\" type=\"password\" name=\"password\" placeholder=\"Passwort\"/>";
        echo "<button type=\"submit\" class=\"btn btn-primary\">Anmelden</button>";
        echo "</form>";

        echo $html->endLoginForm();
        echo $html->footer();
        exit;

    }

    // Check if login.php is called by form
    if(!isset($_POST['username']) && !isset($_POST['password'])) {

        // 1 - it's not
        echo $html->header("TinyERP :: Login");
        echo $html->topbar(false,"");
        echo $html->startLoginForm();

        echo "<h2>TinyERP - Login</h2>";
        echo "<form method=\"post\" action=\"login.php\" class=\"form-group\">";
        echo "<input class=\"form-control\" type=\"text\" name=\"username\" placeholder=\"Benutzername\"/>";
        echo "<input class=\"form-control\" type=\"password\" name=\"password\" placeholder=\"Passwort\"/>";
        echo "<button type=\"submit\" class=\"btn btn-primary\">Anmelden</button>";
        echo "</form>";

        echo $html->endLoginForm();
        echo $html->footer();
        exit;

    }

    // 2.0 - it is, but nothing was sent
    else if($_POST['username'] == "" && $_POST['password'] == "") {

        echo $html->header("TinyERP :: Login");
        echo $html->topbar(false,"");
        echo $html->startLoginForm();

        echo "<h2>TinyERP - Login</h2>";
        echo "<div class=\"alert alert-danger fade in\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>Bitte geben Sie Nutzername und Passwort ein.</div>";
        echo "<form method=\"post\" action=\"login.php\" class=\"form-group\">";
        echo "<input class=\"form-control\" type=\"text\" name=\"username\" placeholder=\"Benutzername\" />";
        echo "<input class=\"form-control\" type=\"password\" name=\"password\" placeholder=\"Passwort\" />";
        echo "<button type=\"submit\" class=\"btn btn-primary\">Anmelden</button>";
        echo "</form>";

        echo $html->endLoginForm();
        echo $html->footer();
        exit;

    }

    // 2.1 - it is, but only the username was given
    else if($_POST['username'] != "" && $_POST['password'] == "") {

        echo $html->header("TinyERP :: Login");
        echo $html->topbar(false,"");
        echo $html->startLoginForm();

        echo "<h2>TinyERP - Login</h2>";
        echo "<div class=\"alert alert-danger fade in\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>Bitte geben Sie ein Passwort ein.</div>";
        echo "<form method=\"post\" action=\"login.php\" class=\"form-group\">";
        echo "<input class=\"form-control\" type=\"text\" name=\"username\" placeholder=\"Benutzername\" value=\"" . $_POST['username'] . "\" />";
        echo "<input class=\"form-control\" type=\"password\" name=\"password\" placeholder=\"Passwort\" />";
        echo "<button type=\"submit\" class=\"btn btn-primary\">Anmelden</button>";
        echo "</form>";

        echo $html->endLoginForm();
        echo $html->footer();
        exit;

    }

    // 2.2 - it is, but only password was given
    else if($_POST['password'] != "" && $_POST['username'] == "") {

        echo $html->header("TinyERP :: Login");
        echo $html->topbar(false,"");
        echo $html->startLoginForm();

        echo "<h2>TinyERP - Login</h2>";
        echo "<div class=\"alert alert-danger fade in\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>Bitte geben Sie einen Nutzernamen ein.</div>";
        echo "<form method=\"post\" action=\"login.php\" class=\"form-group\">";
        echo "<input class=\"form-control\" type=\"text\" name=\"username\" placeholder=\"Benutzername\" />";
        echo "<input class=\"form-control\" type=\"password\" name=\"password\" placeholder=\"Passwort\" />";
        echo "<button type=\"submit\" class=\"btn btn-primary\">Anmelden</button>";
        echo "</form>";

        echo $html->endLoginForm();
        echo $html->footer();
        exit;

    }

    else {
        // TODO check if the credentials are correct, if yes set $_SESSION['user-id']

        $checkSuccessful = false;

        if($checkSuccessful) { // here comes the condition, can be boolean generated by password + username check
            $_SESSION['user-id'] = 1;

            /*
             * this condition cannot have an output,
             * otherwise the Header redirect later in the
             * document is not going to work
             */

        } else {
            // TODO output form with error 'please enter correct username and password'

            echo $html->header("TinyERP :: Login");
            echo $html->topbar(false,"");
            echo $html->startLoginForm();

            echo "<h2>TinyERP - Login</h2>";
            echo "<div class=\"alert alert-danger fade in\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>Diese Zugangsdaten waren nicht richtig.</div>";
            echo "<form method=\"post\" action=\"login.php\" class=\"form-group\">";
            echo "<input class=\"form-control\" type=\"text\" name=\"username\" placeholder=\"Benutzername\" value=\"" . $_POST['username'] . "\" />";
            echo "<input class=\"form-control\" type=\"password\" name=\"password\" placeholder=\"Passwort\" />";
            echo "<button type=\"submit\" class=\"btn btn-primary\">Anmelden</button>";
            echo "</form>";

            echo $html->endLoginForm();
            echo $html->footer();
            exit;

        }
    }

    // did we just set a cookie? cool, back to index.php
    if(isset($_SESSION['user-id'])) {
        Header('Location: index.php');
        exit;
    }