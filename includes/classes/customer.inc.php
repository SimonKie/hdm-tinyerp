<?php

/**
 * Created by PhpStorm.
 * User: Elli
 * Date: 8/30/2016
 * Time: 10:57 AM
 */
class customer
{
    private $id = null;
    private $zipCode;
    private $cityName;
    private $firstName;
    private $lastName;
    private $eMail;
    private $phone;
    private $street;
    private $companyName;

    public function __construct($id,$zipCode,$cityName,$firstName,$lastName,$eMail,$phone,$street,$companyName)
    {
        $this->id = $id;
        $this->zipCode = $zipCode;
        $this->cityName = $cityName;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->eMail = $eMail;
        $this->phone = $phone;
        $this->street = $street;
        $this->companyName = $companyName;

    }

    /**
     * @return mixed
     */
    public function getCityName()
    {
        return $this->cityName;
    }

    /**
     * @param mixed $cityName
     */
    public function setCityName($cityName)
    {
        $this->cityName = $cityName;
    }

    /**
     * @return mixed
     */
    public function getCompanyName()
    {
        return $this->companyName;
    }

    /**
     * @param mixed $companyName
     */
    public function setCompanyName($companyName)
    {
        $this->companyName = $companyName;
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
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param mixed $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * @return null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param null $id
     */
    public function setId($id)
    {
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
     * @param mixed $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param mixed $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    /**
     * @return mixed
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * @param mixed $street
     */
    public function setStreet($street)
    {
        $this->street = $street;
    }

    /**
     * @return mixed
     */
    public function getZipCode()
    {
        return $this->zipCode;
    }

    /**
     * @param mixed $zipCode
     */
    public function setZipCode($zipCode)
    {
        $this->zipCode = $zipCode;
    }

    public function getFullName(){
        return $this->firstName . ",". $this->lastName;

    }


    //Wie schreibt man das richtig? Wofuer braucht man daS?
    public static function getDropdown($customer)
    {
        $content = "
        <select class='dropdown'  name=\"Kunden\">
        <option selected value=\"null\">&nbsp;</option> ";

        foreach ($customer as $c)
        {
            $content .= "<option value=\"" . $c->getId() . "\">" . $c->getFullName() . "\">" . $c->getCompanyName(). "</option>\n";
        }

        $content .= "</select>";

        return $content;
    }


}