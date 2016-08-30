<?php

/**
 * Created by PhpStorm.
 * User: Elli
 * Date: 8/23/2016
 * Time: 11:45 AM
 */
class Employee
{
    private $id = null;
    private $FirstName;
    private $LastName;
    private $EMail;
    private $Phone;


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        if($this->id == null)
            $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->LastName;
    }

    /**
     * @param mixed $LastName
     */
    public function setLastName($LastName)
    {
        $this->LastName = $LastName;
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->FirstName;
    }

    /**
     * @param mixed $FirstName
     * @return Employee
     */
    public function setFirstName($FirstName)
    {
        $this->FirstName = $FirstName;
        // return $this; ???
    }

    /**
     * @return mixed
     */
    public function getEMail()
    {
        return $this->EMail;
    }

    /**
     * @param mixed $EMail
     */
    public function setEMail($EMail)
    {
        $this->EMail = $EMail;
    }

    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->Phone;
    }

    /**
     * @param mixed $Phone
     */
    public function setPhone($Phone)
    {
        $this->Phone = $Phone;
    }

    public function getFullName()
    {
        return $this->LastName . ", " . $this->FirstName;
    }

    public static function getDropdown($Employees)
    {
        $content = "
        <select name=\"Employee\">
        <option selected value=\"null\">&nbsp;</option> ";

        foreach ($Employees as $e)
        {
            //Sollte es nicht getFullName sein?
            $content .="<option value=\"" . $e->getId(). "\">" . $e->FullName() . "</option>\n";
        }

        $content .= "</select>";

        return $content;
    }



}