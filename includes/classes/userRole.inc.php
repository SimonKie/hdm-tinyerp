<?php

/**
 * Created by PhpStorm.
 * User: Elli
 * Date: 8/30/2016
 * Time: 3:15 PM
 */
class UserRole
{
    private $id = null;
    private $name;

    /**
     * userRole constructor.
     * @param null $id
     * @param $name
     */
    public function __construct($name)
    {
        $this->name = $name;
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

    public function listObject()
    {
        $return = '
        <p>Name: ' . $this->getName() . '
        <a href="">bearbeiten</a> | <a href="">löschen</a>
        </p>        
        ';

        return $return;
    }

    public static function getDropdown($userRole)
    {
        $content = "
        <select class='dropdown' name=\"Nutzerrolle\">
        <option selected value=\"null\">&nbsp;</option> ";

        foreach ($userRole as $u)
        {
            $content .= "<option value=\"" . $u->getId() . "\">" . $u->getName() . "</option>\n";
        }

        $content .= "</select>";

        return $content;
    }

}