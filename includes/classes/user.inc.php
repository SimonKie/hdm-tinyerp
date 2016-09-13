<?php

/**
 * Created by PhpStorm.
 * User: Heike
 * Date: 30.08.2016
 * Time: 15:14
 */

class User
{
    private $username;
    private $password;
    private $employee;
    private $userRole;

    /**
     * User constructor.
     */
    public function __construct()
    {
    }

    /**
     * user constructor.
     * @param $username
     * @param $password
     * @param $employee
     * @param $userRole
     */
    public function __construct1($username, $password, $employee, $userRole)
    {
        $this->username = $username;
        $this->password = $password;
        $this->employee = $employee;
        $this->userRole = $userRole;
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
    public function getEmployee()
    {
        return $this->employee;
    }

    /**
     * @param mixed $employee
     */
    public function setEmployee($employee)
    {
        $this->employee = $employee;
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
    public function setUserRole($userRole)
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

        //*UserRole und EmployeeID sind FK -> auch verwenden???

        return $USER;
    }

    public static function getForm(User $user = null)
    {
        $username = '';
        $password = '';

        //*$employee = '';
        //*$userRole = '';

        if($user == null) {
            $hidden = "new";

            $employee = EmployeeMapper::findById();
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
              <input type=\"text\" class=\"input-field\" name=\"username\" value=\"$username\"placeholder=\"Benutzername\" />
            </label>
            <label for=\"name\"><span>Passwort<span class=\"required\">*</span></span> 
              <input type=\"password\" class=\"input-field\" name=\"password\" value=\"$password\"  maxlength=\"200\" placeholder=\"Passwort\" />
            </label>
            
            <label for=\"name\"><span>Rolle<span class=\"required\">*</span></span><select name=\"selection\" class=\"select-field\">
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

}