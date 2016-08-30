<?php

/**
 * Created by PhpStorm.
 * User: Heike
 * Date: 30.08.2016
 * Time: 12:57
 */

class company
{
    private $id = null;
    private $zipCode;
    private $cityName;
    private $name;
    private $bank;
    private $bic;
    private $iban;
    private $registerNr;
    private $eMail;
    private $phone;
    private $street;
    private $ceo;
    private $vatid;

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

    public function __constructor($id, $zipCode, $cityName, $name, $bank, $bic, $iban, $registerNr, $eMail, $phone, $street, $ceo, $vatid){
        $this->id = $id;
        $this->zipCode = $zipCode;
        $this->cityName = $cityName;
        $this->name = $name;
        $this->bank = $bank;
        $this->bic = $bic;
        $this->iban = $iban;
        $this->registerNr = $registerNr;
        $this->eMail = $eMail;
        $this->phone = $phone;
        $this->street = $street;
        $this->ceo = $ceo;
        $this->vatid = $vatid;
    }

    /**
     * @param $company
     * @return string
     */

    public static function getDropdown($company)
    {
        $content = "
        <select name=\"Firma\">
        <option selected value=\"null\">&nbsp;</option> ";

        foreach ($company as $c)
        {
            $content .= "<option value=\"" .$c->getId()."\">" .$c->getName()."</option>\n";
        }

        $content .= "</select>";

        return $content;
    }
}

