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


    /**
     * number constructor.
     * @param $endInt
     * @param null $id
     * @param $prefix
     * @param $startInt
     */
    public function __construct($endInt, $id, $prefix, $startInt)
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