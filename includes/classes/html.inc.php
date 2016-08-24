<?php
/**
 * Created by PhpStorm.
 * User: Simon
 * Date: 24.08.2016
 * Time: 15:58
 * 
 * Offers some functions to build a HTML document
 */

require_once(__DIR__ . "/../config.inc.php");

class HTML {

    /*
     * this class has no attributes, only functions
     */


    /**
     * required. Opens the HTML and adds head area
     * @param $title The title of the page to be shown in the Browser
     * @return string The HTML header code
     */
    function header($title) {

        return
            "<!doctype html>
<html>
    <head>
        <meta charset=\"UTF-8\">
                        
        <title>". $title ."</title>
                        
        <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
        
        <link rel=\"stylesheet\" href=\"http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css\">
        <link rel=\"stylesheet\" type=\"text/css\" href=\"" . HOME_URL . "/includes/css/main.css\" />
        
        <script src=\"https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js\"></script>
        <script src=\"http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js\"></script>
    </head>
    <body>
            ";

    }


    /**
     * required. Closes the HTML
     * @return string The HTML footer code
     */
    function footer() {

        return
            "    
    </body>
</html>";

    }

    /**
     * @param $loggedIn boolean, determines if user is logged in or not
     * @param $user the user. has to be given if $isLoggedIn is true.
     * @return string $the HTML code for the topbar
     */
    function topbar($loggedIn,$user) {

        if($loggedIn) {
            return "         <div class=\"topbar\">
            <div class=\"container\">
                <div class=\"row\">
                    <div class=\"col-xs-8\">
                        <h1>T</h1>
                    </div>
                    
                    <div class=\"col-xs-4 dropdown\">
                        <button class=\"btn btn-primary dropdown-toggle\" id=\"user-menu\" type=\"button\" data-toggle=\"dropdown\"
                                style=\"background: url('" . HOME_URL . "/images/users/example.jpg') no-repeat right 12px center; background-size: 40px 40px;\">
                                " . $user->getFirstName() . " " . $user->getLastName() . " 
                        </button>
                        <ul class=\"dropdown-menu dropdown-menu-right\">
                            <li class=\"dropdown-header\">Verbundene E-Mail-Adresse</li>
                            <li><a href=\"#\">" . $user->getEmail() . "</a></li>
                            <li class=\"divider\"></li>
                            <li><a href=\"#\"><span class=\"glyphicon glyphicon-user\"></span> Profil bearbeiten</a></li>
                            <li><a href=\"#\"><span class=\"glyphicon glyphicon-th-list\"></span> Aktivitäten</a></li>
                            <li><a href=\"#\"><span class=\"glyphicon glyphicon-wrench\"></span> Einstellungen</a></li>
                            <li class=\"divider\"></li>
                            <li><a href=\"./login.php?logout=true\"><span class=\"glyphicon glyphicon-off\"></span> Abmelden</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>";
        }
        else {
            return "         <div class=\"topbar\">
            <div class=\"container\">
                <div class=\"row\">
                    <div class=\"col-xs-12\">
                        <h1>T</h1>
                    </div>
                </div>
            </div>
        </div>";
        }

    }

    function startLoginForm() {
        return "<div class=\"dash\">
        <div class=\"container\">
            <div class=\"row\">
                <div class=\"col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4\">
                    <div class=\"box login\">";
    }

    function endLoginForm() {
        return "
                    </div>
                    <p class=\"copyright\">&copy; " . date('Y') . " HdM GmbH</p>
                </div>
            </div>
        </div>
    </div>";
    }
}