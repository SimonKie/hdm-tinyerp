<?php

/**
 * Created by PhpStorm.
 * User: Elli
 * Date: 8/30/2016
 * Time: 3:15 PM
 */
class userRole
{

    private $id = null;
    private $name;

    /**
     * userRole constructor.
     * @param null $id
     * @param $name
     */
    public function __construct($id, $name)
    {
        $this->id = $id;
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

    
    //Wie schreibt man das richtig? Wofuer braucht man daS?
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