<?php

/**
 * Created by PhpStorm.
 * User: Elli
 * Date: 8/30/2016
 * Time: 12:39 PM
 */

class product
{
    private $id = null;
    private $price;
    private $vat;
    private $number;

    public function __construct($id,$price,$vat,$number)
    {
        $this->id = $id;
        $this->price = $price;
        $this->vat = $vat;
        $this->number = $number;
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
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @param mixed $number
     */
    public function setNumber($number)
    {
        $this->number = $number;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @return mixed
     */
    public function getVat()
    {
        return $this->vat;
    }

    /**
     * @param mixed $vat
     */
    public function setVat($vat)
    {
        $this->vat = $vat;
    }

//Wie schreibt man das richtig? Wofuer braucht man daS?
    public static function getDropdown($product)
    {
        $content = "
        <select name=\"Produkte\">
        <option selected value=\"null\">&nbsp;</option> ";

        foreach ($product as $p)
        {
            $content .= "<option value=\"" . $p->getId() . "\">" . $p->getNumber() ."</option>\n";
        }

        $content .= "</select>";

        return $content;
    }

}