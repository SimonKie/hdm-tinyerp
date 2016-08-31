<?php

/**
 * Created by PhpStorm.
 * User: Daniel
 * Date: 24.08.2016
 * Time: 16:33
 */
class ProductCategory
{
    private $id = null;
    private $name;
    private $description;

    /**
     * ProductCategory constructor.
     * @param $name
     * @param $description
     */
    public function __construct($name, $description)
    {
        $this->name = $name;
        $this->description = $description;
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
        if($this->id == null)
            $this->id = $id;
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

    public function listObject()
    {
        $return = '
        <h6>' . $this->getName() . '</h6>
        <p>Beschreibung: ' . $this->getDescription().'
        <a href="">bearbeiten</a> | <a href="">löschen</a>
        </p>        
        ';

        return $return;
    }

    public static function getDropdown($productCategories)
    {
        $content = "
        <select class='dropdown'  name=\"Produktkategorie\">
        <option selected value=\"null\">&nbsp;</option> ";

        foreach ($productCategories as $PC)
        {
            $content .= "<option value=\"" . $PC->getId() . "\">" . $PC->getName() . "</option>\n";
        }

        $content .= "</select>";

        return $content;
    }

}