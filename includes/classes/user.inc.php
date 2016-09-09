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