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

    public static function formMapper($post)
    {
        $Customer = new Customer();

            $Customer->setId($post['customerid']);
            $Customer->setCompanyName($post['companyName']);
            $Customer->setFirstName($post['firstName']);
            $Customer->setLastName($post['lastName']);
            $Customer->setStreet($post['street']);
            $Customer->setEMail($post['eMail']);
            $Customer->setPhone($post['phone']);
            $Customer->setCity($post['city']);
            $Customer->setZipCode($post['zipCode']);

       /* if(is_numeric($post['zipCode']))

            $Customer->setZipCode(intval($post['zipCode']));
        else
            return "Falsche PLZ.";
*/
        return $Customer;

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
            <form action=\"?id=2\" method=\"POST\">
            <input type=\"hidden\" name=\"action\" value=\"$hidden\" />
            <input type=\"hidden\" name=\"customerid\" value=\"$customerId\" />
            
            <label for=\"name\"><span>Firmename<span class=\"required\">*</span></span> 
              <input type=\"text\" class=\"input-field\" name=\"companyName\" value=\"$companyName\" maxlength=\"100\" placeholder=\"Firmenname\" required/>
            </label>
            
            <label for=\"name\"><span>Vorname<span class=\"required\">*</span></span> 
              <input type=\"text\" class=\"input-field\" name=\"firstName\" value=\"$firstName\" maxlength=\"100\" placeholder=\"Vorname\" required />
            </label>
            
            <label for=\"name\"><span>Nachname<span class=\"required\">*</span></span> 
              <input type=\"text\" class=\"input-field\" name=\"lastName\" value=\"$lastName\" maxlength=\"100\" placeholder=\"Nachname\" required/>
            </label>
            
            <label for=\"name\"><span>Straße<span class=\"required\">*</span></span> 
              <input type=\"text\" class=\"input-field\" name=\"street\" value=\"$street\" maxlength=\"100\" placeholder=\"Straße\" required/>
            </label>
            
            <label for=\"name\"><span>PLZ<span class=\"required\">*</span></span> 
              <input type=\"text\" class=\"input-field\" name=\"zipCode\" value=\"$zipCode\" maxlength=\"11\" placeholder=\"PLZ\" required/>
            </label>
            
            <label for=\"name\"><span>Stadt<span class=\"required\">*</span></span> 
              <input type=\"text\" class=\"input-field\" name=\"city\" value=\"$city\" maxlength=\"60\" placeholder=\"Stadt\" required />
            </label>
            
            <label for=\"name\"><span>Telefon<span class=\"required\">*</span></span> 
              <input type=\"text\" class=\"input-field\" name=\"phone\" value=\"$phone\" maxlength=\"100\" placeholder=\"Telefon\" required/>
            </label>
            
            <label for=\"name\"><span>eMail<span class=\"required\">*</span></span> 
              <input type=\"text\" class=\"input-field\" name=\"eMail\" value=\"$eMail\" maxlength=\"100\" placeholder=\"eMail\" required/>
            </label>
             
            <label><span>&nbsp;</span><input class='btn' type=\"submit\" value=\"speichern\" /></label>
            
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
    
    public static function getTable($customers)
    {
        $content = "
                 <table>
                  <tr>
                    <th>ID</th>
                    <th>Firmennamen</th>
                    <th>Vorname</th>
                    <th>Nachname</th>
                    <th>Strasse</th>
                    <th>PLZ</th>
                    <th>Stadt</th>
                    <th>Telefonnummer</th>
                    <th>EMail</th>
                    <th>&nbsp;</th>
                   </tr>
                ";

        //if no customer is embeded there is a Warning: Invalid argument supplied for foreach() in C:\Users\Daniel\xampp\htdocs\tinyerp\includes\classes\customer.inc.php on line 330
        foreach ($customers as $customer)
        {
            $content .= "
                        <tr>
                         <td>" . $customer->getId() . "</td>
                         <td>" . $customer->getCompanyName() . "</td>
                         <td>" . $customer->getFirstName() . "</td>
                         <td>" . $customer->getLastName() . "</td>
                         <td>" . $customer->getStreet() . "</td>
                         <td>" . $customer->getZipCode() . "</td>
                         <td>" . $customer->getCity() . "</td>
                         <td>" . $customer->getPhone() . "</td>
                         <td>" . $customer->getEMail() . "</td>
                         <td /*class='controls'*/>
                            <button class='btn update' onclick=\"window.location.href='?id=1&customerid=" . $customer->getId() . "'\">&auml;ndern</button>
                            <button class='btn delete' onclick=\"window.location.href='?id=4&customerid=" . $customer->getId() . "'\">l&ouml;schen</button>
                         </td>
                        </tr>
        ";
        }

        $content .= "</table>
                       <button class=\"btn\" onclick=\"window.location.href='?id=3'\">Neuer Kunde</button>
                ";

        return $content;
    }

}

