<?php

/**
 * Created by PhpStorm.
 * User: Elli
 * Date: 8/30/2016
 * Time: 10:57 AM
 */
class Customer
{
    private $id = null;
    private $zipCode;
    private $city;
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
        $this->city = $cityName;
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
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param mixed $city
     */
    public function setCity($city)
    {
        $this->city = $city;
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

    public function listObject()
    {
        $return = '
        <h6>' . $this->getCompanyName() . '</h6>
        <p>Name: ' . $this->getFullName() . 'Phone: ' . $this->getPhone(). 'eMail: ' . $this->getEMail() .
            'Adresse: ' . $this->getStreet() . ' - ' . $this->getZipCode(). ' - '. $this->getCityName().'
        <a href="">bearbeiten</a> | <a href="">löschen</a>
        </p>        
        ';

        return $return;
    }


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