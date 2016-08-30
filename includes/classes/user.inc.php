<?php

/**
 * Created by PhpStorm.
 * User: Heike
 * Date: 30.08.2016
 * Time: 15:14
 */
class user
{
    private $unsername;
    private $password;
    private $employee;
    private $userRole;

    /**
     * user constructor.
     * @param $unsername
     * @param $password
     * @param $employee
     * @param $userRole
     */
    public function __construct($unsername, $password, $employee, $userRole)
    {
        $this->unsername = $unsername;
        $this->password = $password;
        $this->employee = $employee;
        $this->userRole = $userRole;
    }

    /**
     * @return mixed
     */
    public function getUnsername()
    {
        return $this->unsername;
    }

    /**
     * @param mixed $unsername
     */
    public function setUnsername($unsername)
    {
        $this->unsername = $unsername;
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

    public static function getDropdown($user)
    {
        $content = "
        <select name=\"Benutzer\">
        <option selected value=\"null\">&nbsp;</option> ";

        foreach ($user as $u)
        {
            $content .= "<option value=\"" . $u->getId() . "\">" . $u->getEmployee() . "</option>\n";
        }

        $content .= "</select>";

        return $content;
    }

}