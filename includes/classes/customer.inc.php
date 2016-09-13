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

    public function __construct()
    {
    }

    public function __construct1($zipCode,$cityName,$firstName,$lastName,$eMail,$phone,$street,$companyName)
    {
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

//nicht aktuell!!!
    public static function formMapper($post)
    {
        $VAT = new VAT();

        if(strlen($post['description']) < 5)
            return "Falsche Beschreibung.";
        else
            $VAT->setDescription($post['description']);

        if(is_numeric($post['value']))

            $VAT->setValue(floatval($post['value']));
        else
            return "Falscher Steuersatz.";

        return $VAT;
    }


    public static function getForm(Customer $customer = null)
    {
        $companyName = '';
        $firstName = '';
        $lastName ='';
        $street = '';
        $zipCode = '';
        $city = '';
        $phone = '';
        $eMail = '';

        if($customer == null) {
            $hidden = "new";
        }
        else {
            $hidden = "update";
            $customerId = $customer->getId();
            $companyName = $customer->getCompanyName();
            $firstName = $customer->getFirstName();
            $lastName = $customer->getLastName();
            $street = $customer->getStreet();
            $zipCode = $customer->getZipCode();
            $city = $customer->getCity();
            $phone = $customer->getPhone();
            $eMail = $customer->getEMail();
        }


        return "
            <div class=\"form-style-1\">
            <form action=\"\" method=\"POST\">
            <input type=\"hidden\" name=\"action\" value=\"$hidden\" />
            <input type=\"hidden\" name=\"action\" value=\"$customerId\" />
            
            <label for=\"name\"><span>Firmename<span class=\"required\">*</span></span> 
              <input type=\"text\" class=\"input-field\" name=\"companyName\" value=\"$companyName\" maxlength=\"100\" placeholder=\"Firmenname\" />
            </label>
            
            <label for=\"name\"><span>Vorname<span class=\"required\">*</span></span> 
              <input type=\"text\" class=\"input-field\" name=\"firstName\" value=\"$firstName\" maxlength=\"100\" placeholder=\"Vorname\" />
            </label>
            
            <label for=\"name\"><span>Nachname<span class=\"required\">*</span></span> 
              <input type=\"text\" class=\"input-field\" name=\"lastName\" value=\"$lastName\" maxlength=\"100\" placeholder=\"Nachname\" />
            </label>
            
            <label for=\"name\"><span>Straße<span class=\"required\">*</span></span> 
              <input type=\"text\" class=\"input-field\" name=\"street\" value=\"$street\" maxlength=\"100\" placeholder=\"Straße\" />
            </label>
            
            <label for=\"name\"><span>PLZ<span class=\"required\">*</span></span> 
              <input type=\"text\" class=\"input-field\" name=\"zipCode\" value=\"$zipCode\" maxlength=\"11\" placeholder=\"PLZ\" />
            </label>
            
            <label for=\"name\"><span>Stadt<span class=\"required\">*</span></span> 
              <input type=\"text\" class=\"input-field\" name=\"city\" value=\"$city\" maxlength=\"60\" placeholder=\"Stadt\" />
            </label>
            
            <label for=\"name\"><span>Telefon<span class=\"required\">*</span></span> 
              <input type=\"text\" class=\"input-field\" name=\"phone\"value=\"$phone\" maxlength=\"100\" placeholder=\"Telefon\" />
            </label>
            
            <label for=\"name\"><span>eMail<span class=\"required\">*</span></span> 
              <input type=\"text\" class=\"input-field\" name=\"eMail\" value=\"$eMail\" maxlength=\"100\" placeholder=\"eMail\" />
            </label>
             
            <label><span>&nbsp;</span><input type=\"submit\" value=\"speichern\" /></label>
            
            </form>
            </div>
     ";
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