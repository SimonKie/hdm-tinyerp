<?php

/**
 * Created by PhpStorm.
 * User: Daniel
 * Date: 24.08.2016
 * Time: 16:33
 */
class productcategory
{
    private $id = null;
    private $Name;
    private $Description;

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
        if($this->id == null)
            $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->Name;
    }

    /**
     * @param mixed $Name
     */
    public function setName($Name)
    {
        $this->Name = $Name;
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

    public function listObject()
    {
        return "
            <p>$this->Name | $this->Description</p>
        ";
    }

    public static function getDropdown($ProductCategories)
    {
        $content = "
        <select name=\"ProductCategory\">
        <option selected value=\"null\">&nbsp;</option> ";

        foreach ($ProductCategories as $PC)
        {
            $content .= "<option value=\"" . $PC->getId() . "\">" . $PC->getName() . "</option>\n";
        }

        $content .= "</select>";

        return $content;
    }

}