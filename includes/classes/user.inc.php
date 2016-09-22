<?php

/**
 * Created by PhpStorm.
 * User: Heike
 * Date: 30.08.2016
 * Time: 15:14
 */

class User extends Employee
{
    private $username;
    private $password;
    private $userRole;


    /**
     * User constructor.
     */
    public function __construct()
    {
        $arguments = func_get_args();

        switch(sizeof(func_get_args()))
        {
            case 0: //No arguments
                break;
            case 4: //four argument
                $this->__construct1($arguments[0],$arguments[1],$arguments[2],$arguments[3]);
                break;
            case 7:  //seven arguments
                $this->__construct2($arguments[0],$arguments[1],$arguments[2],$arguments[3],$arguments[4],$arguments[5],$arguments[6]);
                break;
        }
    }

    public function __construct1($firstName, $lastName, $eMail, $phone)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->eMail = $eMail;
        $this->phone = $phone;
    }

    /**
     * user constructor.
     * @param $username
     * @param $password
     * @param $employee
     * @param $userRole
     */
    public function __construct2($username, $password, UserRole $userRole, $firstName, $lastName, $eMail, $phone)
    {
        $this->username = $username;
        $this->password = $password;
        $this->userRole = $userRole;
        parent::__construct1($firstName, $lastName, $eMail, $phone);
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getUserRole()
    {
        return $this->userRole;
    }

    /**
     * @param mixed $userRole
     */
    public function setUserRole(UserRole $userRole)
    {
        $this->userRole = $userRole;
    }

    public function listObject()
    {
        $return = '
        <h6>' . $this->getUsername() . '</h6>
        <p>Passwort: ' . $this->getPassword() . 'Rolle: ' . $this->getUserRole(). 'Mitarbeiter: ' . $this->getEmployee().'
        <a href="">bearbeiten</a> | <a href="">löschen</a>
        </p>        
        ';

        return $return;
    }

//*Membermethode employee welche beim anlegen eines Users die Daten vom Employee übernimmt - korrekt?
    public static function employeeMember(){
        $User = new User();
        $User->getId();
        $User->getFirstName();
        $User->getLastName();
        $User->getEMail();
        $User->getPhone();
    }


    public static function formMapper($post)
    {
        $USER = new User();

        if(strlen($post['username']) < 2)
            return "Falsche Eingabe.";
        else
            $USER->setUsername($post['username']);

        if(strlen($post['password']))

            $USER->setPassword($post['password']);
        else
            return "Falsches Passwort.";

        //*UserRole

        return $USER;
    }

    public static function getForm(Employee $user = null)
    {
        $username = '';
        $password = '';

        //*$userRole = '';

        if($user == null) {
            $hidden = "new";
        }
        else {
            $hidden = "update";
            $username = $user->getUsername();
            $password = $user->getPassword();
        }


        return "
            <div class=\"form-style-1\">
            <form action=\"\" method=\"POST\">
            <input type=\"hidden\" name=\"action\" value=\"$hidden\" />
            <input type=\"hidden\" name=\"action\" value=\"$username\" />

            <label for=\"name\"><span>Benutzername<span class=\"required\">*</span></span> 
              <input type=\"text\" class=\"input-field\" name=\"username\" value=\"$username\"placeholder=\"Benutzername\" required />
            </label>
            <label for=\"name\"><span>Passwort<span class=\"required\">*</span></span> 
              <input type=\"password\" class=\"input-field\" name=\"password\" value=\"$password\"  maxlength=\"200\" placeholder=\"Passwort\" required/>
            </label>
            <label for=\"name\"><span>Passwort<span class=\"required\">*</span></span> 
              <input type=\"password\" class=\"input - field\" name=\"password\" value=\"$password\"  maxlength=\"200\" placeholder=\"Passwort wiederholen\" required />
            </label>
            
            <label for=\"name\"><span>Rolle<span class=\"required\">*</span></span><select name=\"selection\" class=\"select-field\" required>
            <option value=\"?php?\">?php?</option>
            <option value=\"?php?\">?php?</option>
            <option value=\"?php?\">?php?</option>
            </select></label>
            
            <label><span>&nbsp;</span><input type=\"submit\" value=\"speichern\" /></label>
            
            </form>
            </div>
        ";
    }


    public static function getDropdown($user)
    {
        $content = "
        <select class='dropdown'  name=\"Benutzer\">
        <option selected value=\"null\">&nbsp;</option> ";

        foreach ($user as $u)
        {
            $content .= "<option value=\"" . $u->getId() . "\">" . $u->getEmployee() . "</option>\n";
        }

        $content .= "</select>";

        return $content;
    }

    public static function getLoginForm($echo = false)
    {
        $content = "
        <div class=\"dash\">
        <div class=\"container\">
            <div class=\"row\">
                <div class=\"col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4\">
                    <div class=\"box login\">
                    <h2>TinyERP - Login</h2>
        ";

        if($echo !== false)
            $content .= "<div class=\"alert alert-success fade in\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>$echo</div>";

        $content .= "
            <form method=\"post\" action=\"login.php\" class=\"form-group\">
            <input class=\"form-control\" type=\"text\" name=\"username\" placeholder=\"Benutzername\" required />
            <input class=\"form-control\" type=\"password\" name=\"password\" placeholder=\"Passwort\" required />
            <button type=\"submit\" class=\"btn btn-primary\">Anmelden</button>
            </form>
            </div>
      
                </div>
            </div>
        </div>
    </div>
        ";

        return $content;

    }

    public static function checkLogin()
    {
        if(isset($_SESSION['USER'])) {

            $User = unserialize($_SESSION['USER']);

            if($User instanceof User && UserMapper::checkLogin($User))
                return true;

        } else
        {
            if(FORCE_LOGIN)
                Header('Location: login.php');
            else
                return true;
        }
    }
}