<?php

/**
 * Created by PhpStorm.
 * User: Heike
 * Date: 30.08.2016
 * Time: 12:57
 */

class Company
{
    private $id = null;
    private $name;
    private $street;
    private $zipCode;
    private $city;
    private $bank;
    private $bic;
    private $iban;
    private $register;
    private $registerNr;
    private $eMail;
    private $ceo;
    private $vatid;

    public function __construct()
    {
    }

    public function __construct1($zipCode, $cityName, $name, $bank, $bic, $iban, $register, $registerNr, $eMail, $street, $ceo, $vatid){
        $this->zipCode = $zipCode;
        $this->city = $cityName;
        $this->name = $name;
        $this->bank = $bank;
        $this->bic = $bic;
        $this->iban = $iban;
        $this->register = $register;
        $this->registerNr = $registerNr;
        $this->eMail = $eMail;
        $this->street = $street;
        $this->ceo = $ceo;
        $this->vatid = $vatid;
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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getBank()
    {
        return $this->bank;
    }

    /**
     * @param mixed $bank
     */
    public function setBank($bank)
    {
        $this->bank = $bank;
    }

    /**
     * @return mixed
     */
    public function getBic()
    {
        return $this->bic;
    }

    /**
     * @param mixed $bic
     */
    public function setBic($bic)
    {
        $this->bic = $bic;
    }

    /**
     * @return mixed
     */
    public function getIban()
    {
        return $this->iban;
    }

    /**
     * @param mixed $iban
     */
    public function setIban($iban)
    {
        $this->iban = $iban;
    }

    /**
     * @return mixed
     */
    public function getRegister()
    {
        return $this->register;
    }

    /**
     * @param mixed $register
     */
    public function setRegister($register)
    {
        $this->register = $register;
    }

    /**
     * @return mixed
     */
    public function getRegisterNr()
    {
        return $this->registerNr;
    }

    /**
     * @param mixed $registerNr
     */
    public function setRegisterNr($registerNr)
    {
        $this->registerNr = $registerNr;
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
    public function getCeo()
    {
        return $this->ceo;
    }

    /**
     * @param mixed $ceo
     */
    public function setCeo($ceo)
    {
        $this->ceo = $ceo;
    }

    /**
     * @return mixed
     */
    public function getVatid()
    {
        return $this->vatid;
    }

    /**
     * @param mixed $vatid
     */
    public function setVatid($vatid)
    {
        $this->vatid = $vatid;
    }

    /**
     * @param $company
     * @return string
     */

    public function listObject()
    {
        $return = '
        <h6>' . $this->getName() . '</h6>
        <p>Adresse: ' . $this->getStreet() . ' - ' . $this->getZipCode(). ' - '. $this->getCityName()
        .' CEO: ' . $this->getCeo() . 'eMail: ' . $this->getEMail()
        .' Bank: ' . $this->getBank() . 'BIC: ' . $this->getBic(). 'IBAN: ' . $this->getIban()
        .'Register: ' .$this->getRegister() . 'RegisterNr: ' .$this->getRegisterNr() .'MwSt: ' .$this->getVatid() . '
        <a href="">bearbeiten</a> | <a href="">löschen</a>
        </p>        
        ';

        return $return;
    }


    public static function formMapper($post)
    {
        $company = new Company();
            $company->setName($post['name']);
            $company->setStreet($post['street']);
            $company->setCity($post['city']);
            $company->setEMail($post['eMail']);
            $company->setBank($post['bank']);
            $company->setIban($post['iban']);
            $company->setBic($post['bic']);
            $company->setCeo($post['ceo']);
            $company->setRegister($post['register']);
            $company->setRegisterNr($post['registerNr']);
            $company->setVatid($post['vatId']);

        if(is_numeric($post['zipCode']))
            $company->setZipCode(intval($post['zipCode']));
        else
            return "Falsche PLZ Eingabe.";

        return $company;
    }


    public static function getForm(Company $company = null)
    {
        $name = '';
        $street = '';
        $zipCode = '';
        $city = '';
        $eMail = '';
        $bank = '';
        $iban = '';
        $bic = '';
        $ceo = '';
        $register = '';
        $registerNr = '';
        $vatId = '';

        if($company == null) {
            $hidden = "new";
        }
        else {
            $hidden = "update";
            $companyId = $company->getId();
            $name = $company->getName();
            $street = $company->getStreet();
            $zipCode = $company->getZipCode();
            $city = $company->getCity();
            $eMail = $company->getEMail();
            $bank = $company->getBank();
            $iban = $company->getIban();
            $bic = $company->getBic();
            $ceo = $company->getCeo();
            $register = $company->getRegister();
            $registerNr = $company->getRegisterNr();
            $vatId = $company->getVatid();
        }


        return "
<div class=\"form-style-1\">
<form action=\"\" method=\"POST\">
<input type=\"hidden\" name=\"action\" value=\"$hidden\" />
<input type=\"hidden\" name=\"action\" value=\"$companyId\">

<label for=\"name\"><span>Name<span class=\"required\">*</span></span> 
  <input type=\"text\" class=\"input-field\" name=\"name\" vaue=\"$name\" maxlength=\"100\" placeholder=\"Name\" required/>
</label>

<label for=\"name\"><span>Straße<span class=\"required\">*</span></span> 
  <input type=\"text\" class=\"input-field\" name=\"street\" value=\"$street\" maxlength=\"100\" placeholder=\"Straße\" required/>
</label>

<label for=\"name\"><span>PLZ<span class=\"required\">*</span></span> 
  <input type=\"text\" class=\"input-field\" name=\"plz\" value=\"$zipCode\" maxlength=\"11\" placeholder=\"PLZ\" required/>
</label>

<label for=\"name\"><span>Stadt<span class=\"required\">*</span></span> 
  <input type=\"text\" class=\"input-field\" name=\"city\" value=\"$city\" maxlength=\"60\" placeholder=\"Stadt\" required/>
</label>

<label for=\"name\"><span>eMail<span class=\"required\">*</span></span> 
  <input type=\"text\" class=\"input-field\" name=\"eMail\" value=\"$eMail\" maxlength=\"100\" placeholder=\"eMail\" required/>
</label>

<label for=\"name\"><span>Bank<span class=\"required\">*</span></span> 
  <input type=\"text\" class=\"input-field\" name=\"bank\" value=\"$bank\" maxlength=\"100\" placeholder=\"Bank\" required/>
</label>

<label for=\"name\"><span>IBAN<span class=\"required\">*</span></span> 
  <input type=\"text\" class=\"input-field\" name=\"iban\" value=\"$iban\" maxlength=\"34\" placeholder=\"IBAN\" required/>
</label>

<label for=\"name\"><span>BIC<span class=\"required\">*</span></span> 
  <input type=\"text\" class=\"input-field\" name=\"bic\" value=\"$bic\" maxlength=\"11\" placeholder=\"BIC\" required/>
</label>

<label for=\"name\"><span>CEO<span class=\"required\">*</span></span> 
  <input type=\"text\" class=\"input-field\" name=\"ceo\" value=\"$ceo\" maxlength=\"100\" placeholder=\"CEO\" required/>
</label>

<label for=\"name\"><span>Registername<span class=\"required\">*</span></span> 
  <input type=\"text\" class=\"input-field\" name=\"register\" value=\"$register\" maxlength=\"100\" placeholder=\"Registername\" required/>
</label>

<label for=\"name\"><span>Registernummer<span class=\"required\">*</span></span> 
  <input type=\"text\" class=\"input-field\" name=\"registerNr\" value=\"$registerNr\" maxlength=\"45\" placeholder=\"Registernummer\" required/>
</label>

<label for=\"name\"><span>Steuernummer<span class=\"required\">*</span></span> 
  <input type=\"text\" class=\"input-field\" name=\"vatId\" value=\"$vatId\" maxlength=\"45\" placeholder=\"Steuernummer\" required/>
</label>


<label><span>&nbsp;</span><input type=\"submit\" value=\"speichern\" /></label>

</form>
</div>
        ";
    }


    public static function getDropdown($company)
    {
        $content = "
        <select class='dropdown'  name=\"Firma\">
        <option selected value=\"null\">&nbsp;</option> ";

        foreach ($company as $c)
        {
            $content .= "<option value=\"" .$c->getId()."\">" .$c->getName()."</option>\n";
        }

        $content .= "</select>";

        return $content;
    }

}