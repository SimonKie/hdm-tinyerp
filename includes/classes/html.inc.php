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
                        
        <link rel=\"stylesheet\" type=\"text/css\" href=\"" . HOME_URL . "/includes/css/bootstrap.min.css\" />
        <link rel=\"stylesheet\" type=\"text/css\" href=\"" . HOME_URL . "/includes/css/bootstrap-theme.min.css\" />
        <link rel=\"stylesheet\" type=\"text/css\" href=\"" . HOME_URL . "/includes/css/main.css\" />
        
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
                        <p class=\"user\">" . $user->getFirstName() . " " . $user->getLastName() . "
                        <img src=\"" . HOME_URL . "/images/users/example.jpg\" alt=\"" . $user->getFirstName() . " " . $user->getLastName() . "\" /></p>
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