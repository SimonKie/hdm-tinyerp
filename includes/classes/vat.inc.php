<?php

/**
 * Created by PhpStorm.
 * User: Daniel
 * Date: 22.08.2016
 * Time: 22:29
 */
class VAT
{
    private $id;
    private $Value;
    private $Description;
    private $StartDate;
    private $EndDate;

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
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->Value;
    }

    /**
     * @return mixed
     */
    public function getValueasPercent()
    {
        return intval($this->Value*100);
    }

    /**
     * @param mixed $Value
     */
    public function setValue($Value)
    {
        $this->Value = $Value;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->Description;
    }

    /**
     * @param mixed $Description
     */
    public function setDescription($Description)
    {
        $this->Description = $Description;
    }

    /**
     * @return mixed
     */
    public function getStartDate()
    {
        return $this->StartDate;
    }

    /**
     * @param mixed $StartDate
     */
    public function setStartDate($StartDate)
    {
        $this->StartDate = $StartDate;
    }

    /**
     * @return mixed
     */
    public function getEndDate()
    {
        return $this->EndDate;
    }

    /**
     * @param mixed $EndDate
     */
    public function setEndDate($EndDate)
    {
        $this->EndDate = $EndDate;
    }

    public function listObject()
    {
        $return = '<div>
        <h1>' . $this->getDescription() . '</h1>
        <p>Steuersatz: ' . $this->getValueasPercent() . ' gültig: ' . $this->getStartDate() . ' - ' . $this->getEndDate() . '
        <a href="">bearbeiten</a> | <a href="">löschen</a>
        </p>        
        ';
        
        return $return;
    }

}