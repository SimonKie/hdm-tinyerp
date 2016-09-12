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
    private $firstName;
    private $lastName;
    private $eMail;
    private $phone;

    /**
     * Employee constructor.
     * @param null $id
     * @param $firstName
     * @param $lastName
     * @param $eMail
     * @param $phone
     */

    public function __construct()
    {
    }

    public function __construct1($firstName, $lastName, $eMail, $phone)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->eMail = $eMail;
        $this->phone = $phone;
    }


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
        return $this->lastName;
    }

    /**
     * @param mixed $LastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param mixed $FirstName
     * @return Employee
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
        // return $this; ???
    }

    /**
     * @return mixed
     */
    public function getEMail()
    {
        return $this->eMail;
    }

    /**
     * @param mixed $eMail
     */
    public function setEMail($eMail)
    {
        $this->eMail = $eMail;
    }

    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param mixed $Phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    public function getFullName()
    {
        return $this->lastName . ", " . $this->firstName;
    }

    public function listObject()
    {
        $return = '
        <h6>' . $this->getFullName() . '</h6>
        <p>eMail: ' . $this->getEMail() . 'Phone: ' . $this->getPhone().'
        <a href="">bearbeiten</a> | <a href="">löschen</a>
        </p>        
        ';

        return $return;
    }

    public static function getDropdown($employee)
    {
        $content = "
        <select class='dropdown'  name=\"Mitarbeiter\">
        <option selected value=\"null\">&nbsp;</option> ";

        foreach ($employee as $e)
        {
            //Sollte es nicht getFullName sein?
            $content .="<option value=\"" . $e->getId(). "\">" . $e->FullName() . "</option>\n";
        }

        $content .= "</select>";

        return $content;
    }



}