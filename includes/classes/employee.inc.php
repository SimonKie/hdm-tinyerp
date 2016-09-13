<?php

/**
 * Created by PhpStorm.
 * User: Elli
 * Date: 8/23/2016
 * Time: 11:45 AM
 */
class Employee
{
    protected $id = null;
    protected $firstName;
    protected $lastName;
    protected $eMail;
    protected $phone;

    /**
     * Employee constructor.
     * @param null $id
     * @param $firstName
     * @param $lastName
     * @param $eMail
     * @param $phone
     */

    public function __construct()
    {
    }

    public function __construct1($firstName, $lastName, $eMail, $phone)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->eMail = $eMail;
        $this->phone = $phone;
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
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param mixed $LastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param mixed $FirstName
     * @return Employee
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
        // return $this; ???
    }

    /**
     * @return mixed
     */
    public function getEMail()
    {
        return $this->eMail;
    }

    /**
     * @param mixed $eMail
     */
    public function setEMail($eMail)
    {
        $this->eMail = $eMail;
    }

    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param mixed $Phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    public function getFullName()
    {
        return $this->lastName . ", " . $this->firstName;
    }

    public function listObject()
    {
        $return = '
        <h6>' . $this->getFullName() . '</h6>
        <p>eMail: ' . $this->getEMail() . 'Phone: ' . $this->getPhone().'
        <a href="">bearbeiten</a> | <a href="">löschen</a>
        </p>        
        ';

        return $return;
    }

    public static function formMapper($post)
    {
        $employee = new Employee();
            $employee->setFirstName($post['firstName']);
            $employee->setLastName($post['lastName']);
            $employee->setPhone($post['phone']);
            $employee->setEMail($post['eMail']);

        return $employee;
    }

    public static function getForm(Employee $employee = null)
    {
        $employeeId = '';
        $firstName = '';
        $lastName = '';
        $eMail = '';
        $phone = '';

        if($employee == null) {
            $hidden = "new";
        }
        else {
            $hidden = "update";
            $employeeId = $employee->getId();
            $firstName = $employee->getFirstName();
            $lastName = $employee->getLastName();
            $eMail = $employee->getEMail();
            $phone = $employee->getPhone();
        }


        return "
            <div class=\"form-style-1\">
            <form action=\"?id=2\" method=\"POST\">
            <input type=\"hidden\" name=\"action\" value=\"$hidden\" />
            <input type=\"hidden\" name=\"employeeId\" value=\"$employeeId\" />
            <label for=\"name\"><span>Vorname<span class=\"required\">*</span></span> 
              <input type=\"text\" class=\"input-field\" name=\"firstName\" value=\"$firstName\" maxlength=\"100\" placeholder=\"Vorname\" required />
            </label>
            <label for=\"name\"><span>Nachname<span class=\"required\">*</span></span> 
              <input type=\"text\" class=\"input-field\" name=\"lastName\" value=\"$lastName\" maxlength=\"100\" placeholder=\"Nachname\" required/>
            </label>
            <label for=\"name\"><span>EMail<span class=\"required\">*</span></span> 
              <input type=\"text\" class=\"input-field\" name=\"eMail\" value=\"$eMail\" maxlength=\"100\" placeholder=\"eMail\" required/>
            </label>
            <label for=\"name\"><span>Telefon<span class=\"required\">*</span></span> 
              <input type=\"text\" class=\"input-field\" name=\"phone\" value=\"$phone\" maxlength=\"100\" placeholder=\"Telefon\" required/>
            </label>
            
            <label><span>&nbsp;</span><input type=\"submit\" value=\"speichern\" /></label>
            
            </form>
            </div>
        ";
    }
    
    public static function getDropdown($employee)
    {
        $content = "
        <select class='dropdown'  name=\"Mitarbeiter\">
        <option selected value=\"null\">&nbsp;</option> ";

        foreach ($employee as $e)
        {
            //Sollte es nicht getFullName sein?
            $content .="<option value=\"" . $e->getId(). "\">" . $e->FullName() . "</option>\n";
        }

        $content .= "</select>";

        return $content;
    }



}