<?php

/**
 * Created by PhpStorm.
 * User: Daniel
 * Date: 22.08.2016
 * Time: 22:29
 */
class Vat
{
    private $id = null;
    private $value;
    private $description;
    private $startDate;
    private $endDate;


    /**
     * Vat constructor.
     */
    public function __construct()
    {
    }

    /**
     * Vat constructor.
     * @param $value
     * @param $description
     * @param $startDate
     * @param $endDate
     */
    public function __construct1($value, $description, $startDate, $endDate)
    {
        $this->value = $value;
        $this->description = $description;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
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
        if($this->id == null && $id !== null)
            $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return mixed
     */
    public function getValueasPercent()
    {
        return intval($this->value*100);
    }

    /**
     * @param mixed $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * @param mixed $startDate
     */
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;
    }

    /**
     * @return mixed
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * @param mixed $endDate
     */
    public function setEndDate($endDate)
    {
        $this->endDate = $endDate;
    }


    public function listObject()
    {
        $return = '
        <h6>' . $this->getDescription() . '</h6>
        <p>Wert: ' . $this->getValue() . 'in Prozent: ' . $this->getValueasPercent(). 'Start Datum: ' . $this->getStartDate().
            'End Datum: ' . $this->getEndDate().'
        <a href="">bearbeiten</a> | <a href="">löschen</a>
        </p>        
        ';

        return $return;
    }

    public static function getDropdown($VATs)
    {
        $content = "
        <select class='dropdown' name=\"Steuersatz\">
        <option selected value=\"null\">&nbsp;</option> ";

        foreach ($VATs as $v)
        {
            $content .= "<option value=\"" . $v->getId(). "\">" . $v->getDescription() . "</option>\n";
        }

        $content .= "</select>";

        return $content;
    }
}