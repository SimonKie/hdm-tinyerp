<?php

/**
 * Created by PhpStorm.
 * User: Elli
 * Date: 8/30/2016
 * Time: 12:48 PM
 */
class Number
{
    private $id = null;
    private $prefix;
    private $startInt;
    private $endInt;

    /** Zusammengesetzter Schlüssel (Präfix) fehlt evtl? */

    public function __construct()
    {
    }

    /**
     * number constructor.
     * @param $endInt
     * @param null $id
     * @param $prefix
     * @param $startInt
     */
    public function __construct1($endInt, $id, $prefix, $startInt)
    {
        $this->endInt = $endInt;
        $this->id = $id;
        $this->prefix = $prefix;
        $this->startInt = $startInt;
    }

    /**
     * @return mixed
     */
    public function getEndInt()
    {
        return $this->endInt;
    }

    /**
     * @param mixed $endInt
     */
    public function setEndInt($endInt)
    {
        $this->endInt = $endInt;
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
    public function getPrefix()
    {
        return $this->prefix;
    }

    /**
     * @param mixed $prefix
     */
    public function setPrefix($prefix)
    {
        $this->prefix = $prefix;
    }

    /**
     * @return mixed
     */
    public function getStartInt()
    {
        return $this->startInt;
    }

    /**
     * @param mixed $startInt
     */
    public function setStartInt($startInt)
    {
        $this->startInt = $startInt;
    }


//*nicht befüllt
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

    public static function getForm(Number $number = null)
    {
        $numberId = '';
        $prefix = '';
        $startInt = '';
        $endInt = '';

        if($number == null) {
            $hidden = "new";
        }
        else {
            $hidden = "update";
            $numberId = $number->getId();
            $prefix = $number->getPrefix();
            $startInt = $number->getStartInt();
            $endInt = $number->getEndInt();
        }

        return "
            <div class=\"form-style-1\">
            <form action=\"\" method=\"POST\">
            <input type=\"hidden\" name=\"action\" value=\"$hidden\" />
            <input type=\"hidden\" name=\"action\" value=\"$numberId\" />
            
            <label for=\"name\"><span>Präfix<span class=\"required\">*</span></span> 
              <input type=\"text\" class=\"input-field\" name=\"prefix\" value=\"$prefix\" placeholder=\"2016\" required/>
            </label>
            <label for=\"name\"><span>Startnummer<span class=\"required\">*</span></span> 
              <input type=\"text\" class=\"input-field\" name=\"startInt\" value=\"$startInt\" maxlength=\"100\" placeholder=\"Startnummer\" required/>
            </label>
            
            <label for=\"name\"><span>Endnummer<span class=\"required\">*</span></span> 
              <input type=\"text\" class=\"input-field\" name=\"endInt\" value=\"$endInt\" maxlength=\"100\" placeholder=\"Endnummer\" required/>
            </label>
            
            <label><span>&nbsp;</span><input type=\"submit\" value=\"speichern\" /></label>
            
            </form>
            </div>";
    }



    public function listObject()
    {
        $return = '
        <h6>' . $this->getPrefix() . '</h6>
        <p>Start: ' . $this->getStartInt() . 'Ende: ' . $this->getEndInt(). '
        <a href="">bearbeiten</a> | <a href="">löschen</a>
        </p>        
        ';

        return $return;
    }
    
//Wie schreibt man das richtig? Wofuer braucht man daS?
    public static function getDropdown($number)
    {
        $content = "
        <select class='dropdown'  name=\"Rechnungsnummer\">
        <option selected value=\"null\">&nbsp;</option> ";

        foreach ($number as $n)
        {
            $content .= "<option value=\"" . $n->getId() . "\">" . $n->getPrefix() . "</option>\n";
        }

        $content .= "</select>";

        return $content;
    }

}