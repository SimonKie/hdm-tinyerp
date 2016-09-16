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

    public function __construct()
    {
        $arguments = func_get_args();

        switch(sizeof(func_get_args()))
        {
            case 0: //No arguments
                break;
            case 1: //One argument
                $this->__construct1($arguments[0]);
                break;
        }
    }


    /**
     * userRole constructor.
     * @param null $id
     * @param $name
     */
    public function __construct1($name)
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

    public static function getForm(UserRole $userRole = null)
    {
        $userRoleId = '';
        $name = '';
        

        if($userRole == null) {
            $hidden = "new";
        }
        else {
            $hidden = "update";
            $userRoleId = $userRole->getId();
            $name = $userRole->getName();
        }


        return "
<div class=\"form-style-1\">
<form action=\"?id=2\" method=\"POST\">
<input type=\"hidden\" name=\"action\" value=\"$hidden\" />
<input type=\"hidden\" name=\"userRoleId\" value=\"$userRoleId\" />
<label for=\"name\"><span>Bezeichnung<span class=\"required\">*</span></span> 
  <input type=\"text\" class=\"input-field\" name=\"name\" maxlength=\"100\" value=\"$name\" placeholder=\"Admin\" />
</label>

<label><span>&nbsp;</span><input type=\"submit\" value=\"speichern\" /></label>

</form>
</div>
        ";
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