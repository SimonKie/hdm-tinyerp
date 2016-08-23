<?php

/**
 * Created by PhpStorm.
 * User: Daniel
 * Date: 22.08.2016
 * Time: 23:46
 */

require_once('config.inc.php');

class Page
{
    private $Title = "tinyERP";
    private $Content = "Error 404!";
    private $RightArea = "Fortschritt";

    private $MainNav = array(
        'Home' => 'index.php',
        'Rechnungen' => '',
        'Kunden' => ''
    );

    /**
     * @param string $Title
     */
    public function setTitle($Title)
    {
        $this->Title = $Title;
    }

    /**
     * @param string $Content
     */
    public function setContent($Content)
    {
        $this->Content = $Content;
    }

    /**
     * @param string $rightCol
     */
    public function setRightArea($RightArea)
    {
        $this->RightArea = $RightArea;
    }

    /**
     * @return string
     */
    private function getHeader()
    {
        return "
<!DOCTYPE html>
<html lang=\"de\">
<head>
    <meta charset=\"UTF-8\">
    <title>$this->Title</title>
    
    <!-- css -->
    <link rel=\"stylesheet\" type=\"text/css\" href=\"includes/css/bootstrap.min.css\" />
    <link rel=\"stylesheet\" type=\"text/css\" href=\"includes/css/bootstrap-theme.min.css\" />
    <link rel=\"stylesheet\" type=\"text/css\" href=\"includes/css/main.css\" />
    
    
</head>
<body>
    <div class=\"topbar\">
        <div class=\"container\">
            <div class=\"row\">
                <div class=\"col-sm-6\">
                    <h1>TinyERP</h1>
                </div>
                <div class=\"col-sm-6\">
                    <p class=\"user\">Max Mustermann</p>
                </div>
            </div>
        </div>
    </div>
    <div class=\"dash\">
        <div class=\"container\">
            <div class=\"row\">
        ";
    }

    /**
     * @return string
     */
    private function getMainNav()
    {
        $return = "<ul class=\"MainNav\">";

        foreach($this->MainNav as $key => $value)
        {
            $return .= "<li><a href='$value'>$key</a></li>";
        }

        $return .= "</ul>";

        return $return;
    }

    /**
     * @return string
     */
    private function getLeftArea($LeftArea)
    {
        return "
                <!-- left area -->
                <div class=\"col-sm-3\">
                    <div class=\"box\">
                        <h2>Hauptmenü</h2>
                        $LeftArea
                    </div>
                    <div class=\"box\">
                        <h2>Statistiken</h2>
                    </div>
                </div>       
        ";
    }

    private function getContent()
    {
        return "
                <!-- center area -->
                <div class=\"col-sm-6\">
                    <div class=\"box\">
                        $this->Content
                    </div>
                </div>
        ";
    }

    private function getRightArea()
    {
        return "
                <!-- right area -->
                <div class=\"col-sm-3\">
                    <div class=\"box\">
                        <h2>$this->RightArea &nbsp;</h2>
                    </div>
                </div>        
        ";
    }

    /**
     * @return string
     */
    private function getFooter()
    {
        return "
            </div>
        </div>
    </div>
</body>
</html>
        ";
    }

    public function run()
    {
        echo $this->getHeader();
        echo $this->getLeftArea($this->getMainNav());
        echo $this->getContent();
        echo $this->getRightArea();
        echo $this->getFooter();

    }
}