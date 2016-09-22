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
    private $title = "tinyERP";
    private $content = "Error 404!";
    private $rightArea = "&nbsp;";
    private $loggedIn = false;
    private $User = null;

    // Links for main navigation menu
    private $mainNav = array(
        'Home' => 'index.php',
        'Rechnungen' => '',
        'Stammdaten' => 'vat.php'
    );

    // Links for masterdata navigabtion menu
    private $masterDataNav = array(
        'Firma' => '',
        'Mitarbeiter' => '',
        'Steuersätze' => 'vat.php',
        'Produktkategorien' => 'productcategory.php',
        'Produkte' => '',
        'tinyERP' => ''
    );

    public function __construct()
    {
        // Check if user is logged in
        if(isset($_SESSION['USER']))
            $this->User = unserialize($_SESSION['USER']);

        // Check if selected user is valid
        if($this->User instanceof User && UserMapper::checkLogin($this->User))
            $this->loggedIn = true;

        // If Login function is disabled a dummy user will be initialized
        if(!FORCE_LOGIN) {
            $this->loggedIn = true;
            $this->User = new User('admin','',new UserRole('UserRole1'),'Admin','User','email@email.com','00');
        }
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @param string $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @param string $rightCol
     */
    public function setRightArea($rightArea)
    {
        $this->rightArea = $rightArea;
    }

    /**
     * @param boolean $loggedIn
     */
    public function setLoggedIn($loggedIn)
    {
        $this->loggedIn = $loggedIn;
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
        <meta charset=\"UTF - 8\">
        <title>$this->title</title>
        
        <!-- css -->
        <link rel=\"stylesheet\" href=\"http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css\">
        <link rel = \"stylesheet\" type = \"text/css\" href = \"includes/css/main.css\" />
        <link rel = \"stylesheet\" type = \"text/css\" href = \"includes/css/form.css\" />
        
        <script src = \"https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js\" ></script >
        <script src = \"http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js\" ></script >
        
        
    </head >
    <body >
        ";
      }

      private function getTopbar()
      {
        if($this->loggedIn) {
            return "
        <div class=\"topbar\">
                <div class=\"container\">
                    <div class=\"row\">
                        <div class=\"col-xs-8\">
                            <h1>T</h1>
                        </div>                   
                        <div class=\"col-xs-4 dropdown\">
                            <button class=\"btn btn-primary dropdown-toggle\" id=\"user-menu\" type=\"button\" data-toggle=\"dropdown\"
                                    style=\"background: url('" . HOME_URL . "/images/users/example.jpg') no-repeat right 12px center; background-size: 40px 40px;\">
                                    <span class=\"badge\">" . $this->User->getUserRole()->getName() . "</span> " .  $this->User->getUsername() . " 
                            </button>
                            <ul class=\"dropdown-menu dropdown-menu-right\">
                                <li class=\"dropdown-header\">Verbundene E-Mail-Adresse</li>
                                <li><a href=\"mailto:" . $this->User->getEMail() . "\">" .  $this->User->getEMail() . "</a></li>
                                <li class=\"divider\" ></li >
                                <li ><a href = \"#\" ><span class=\"glyphicon glyphicon-user\" ></span > Profil bearbeiten </a ></li >
                                <li ><a href = \"login.php?logout=true\" ><span class=\"glyphicon glyphicon-off\" ></span > Abmelden</a ></li >
                            </ul >
                        </div >
                    </div >
                </div >
            </div > 
            <div class=\"dash\">
                <div class=\"container\">
                    <div class=\"row\">";
        }
        else {
            return "         <div class=\"topbar\">
            <div class=\"container\">
                <div class=\"row\">
                    <div class=\"col - xs - 12\">
                        <h1>T</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class=\"dash\">
            <div class=\"container\">
                <div class=\"row\">
        ";
        }
    }

    /**
     * @return string
     */
    private function getMainNav()
    {
        $return = "<h2>Hauptmen&uuml;</h2>
                    <ul class=\"main-nav\">";

        foreach($this->mainNav as $key => $value)
        {
            $return .= "<li><a href=\"$value\">$key</a></li>\n";
        }

        $return .= "</ul>";

        return $return;
    }

    public function getMasterDataNav()
    {
        $return = "<h2>Stammdaten</h2>
                    <ul class=\"sub-nav\">";

        foreach($this->masterDataNav as $key => $value)
        {
            $return .= "<li><a href=\"$value\">$key</a></li>\n";
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
                        $LeftArea
                    </div>
                    <div class=\"box\">
                        <h2>Statistiken</h2>
                    </div>
                </div>       
        ";
    }

    /**
     * @return string
     */
    private function getContent()
    {
        return "
                <!-- center area -->
                <div class=\"col-sm-6\">
                    <div class=\"box\">
                        $this->content
                    </div>
                </div>
        ";
    }

    /**
     * @return string
     */
    private function getRightArea()
    {
        return "
                <!-- right area -->
                <div class=\"col-sm-3\">
                    <div class=\"box\">
                        $this->rightArea &nbsp;
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
    <div class=\"container\">
        <div class=\"row\">
            <div class=\"col-xs-12\">
                <p class=\"copyright\">&copy; " . date('Y') . " HdM GmbH</p>
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

        if($this->loggedIn) {
            echo $this->getTopbar();
            echo $this->getLeftArea($this->getMainNav());
            echo $this->getContent();
            echo $this->getRightArea();
        } else
        {
            echo $this->getTopbar();
            echo $this->content;
        }

        echo $this->getFooter();
        die();
    }
}