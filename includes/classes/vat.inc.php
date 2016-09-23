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
        <a href="">bearbeiten</a> | <a href="">l&ouml;schen</a>
        </p>        
        ';

        return $return;
    }

    public static function formMapper($post)
    {
        // Processing the VAT Data from the post var

        $VAT = new VAT();

        $VAT->setId(intval($post['vatid']));

        if(strlen($post['description']) < 3)
            return "Falsche Beschreibung.";
        else
            $VAT->setDescription($post['description']);

        if(is_numeric($post['value']))

            $VAT->setValue(floatval($post['value']));
        else
            return "Falscher Steuersatz.";

        if(!empty($post['startDate']))
            $VAT->setStartDate(new DateTime($post['startDate']));

        if(!empty($post['endDate']))
            $VAT->setEndDate(new DateTime($post['endDate']));

        return $VAT;
    }

    public static function getForm(VAT $VAT = null)
    {
        // return VAT HTML Form

        $vatid = '';
        $value = '';
        $description = '';
        $startDate = '';
        $endDate = '';

        if($VAT == null) {
            // No parameter was given, return the Form without content
            $hidden = "new";
        }
        else {
            // Insert VAT Data in HTML from the Object given as parameter
            $hidden = "update";
            $vatid = $VAT->getId();
            $value = $VAT->getValue();
            $description = $VAT->getDescription();
            $startDate = $VAT->getStartDate()->format('Y-m-d');
            $endDate = $VAT->getEndDate()->format('Y-m-d');
        }

        return "
<div class=\"form-style-1\">
<form action=\"?id=2\" method=\"POST\">
<input type=\"hidden\" name=\"action\" value=\"$hidden\" />
<input type=\"hidden\" name=\"vatid\" value=\"$vatid\" />
<label for=\"name\"><span>Wert<span class=\"required\">*</span></span> 
  <input type=\"text\" class=\"input-field\" name=\"value\" maxlength=\"100\" value=\"$value\" placeholder=\"0.19\" required />
</label>
<label for=\"name\"><span>Beschreibung<span class=\"required\">*</span></span> 
  <input type=\"text\" class=\"input-field\" name=\"description\" maxlength=\"100\" value=\"$description\" placeholder=\"19%\" required />
</label>
<label for=\"name\"><span>Anfangsdatum<span class=\"required\">*</span></span> 
  <input type=\"date\" class=\"input-field\" name=\"startDate\" value=\"$startDate\" />
</label>
<label for=\"name\"><span>Enddatum<span class=\"required\">*</span></span> 
  <input type=\"date\" class=\"input-field\" name=\"endDate\" value=\"$endDate\" />
</label>

<label><span>&nbsp;</span><input class='btn' type=\"submit\" value=\"speichern\" /></label>

</form>
</div>
        ";
    }

    public static function getDropdown($VATs, $selected = null)
    {
        // generate Dropdown for VAT

        $content = "<select class='dropdown' name=\"Steuersatz\">";

        if($selected == null)
            $content .= "<option selected value=\"null\">&nbsp;</option> ";

        foreach ($VATs as $v)
        {
            $optiontag = "";

            if($v->getId() == $selected)
                $optiontag = "selected";

            $content .= "<option $optiontag value=\"" . $v->getId(). "\">" . $v->getDescription() . "</option>\n";
        }

        $content .= "</select>";

        return $content;
    }

    public static function getTable($VATs)
    {
        $content = "
                 <table>
                  <tr>
                    <th>ID</th>
                    <th>Steuersatz</th>
                    <th>Beschreibung</th>
                    <th>Startdatum</th>
                    <th>Enddatum</th>
                    <th>&nbsp;</th>
                   </tr>
                ";

        foreach ($VATs as $vat)
        {
            $content .= "
                        <tr>
                         <td>" . $vat->getId() . "</td>
                         <td>" . $vat->getValue() . "</td>
                         <td>" . $vat->getDescription() . "</td>
                         <td>" . $vat->getStartDate()->format('d.m.Y') . "</td>
                         <td>" . $vat->getEndDate()->format('d.m.Y') . "</td>
                         <td class='controls'>
                            <button class='btn update' onclick=\"window.location.href='?id=1&vatid=" . $vat->getId() . "'\">&auml;ndern</button>
                            <button class='btn delete' onclick=\"window.location.href='?id=4&vatid=" . $vat->getId() . "'\">l&ouml;schen</button>
                         </td>
                        </tr>
        ";
        }

        $content .= "</table>
                       <button class=\"btn\" onclick=\"window.location.href='?id=3'\">Neuer Steuersatz</button>
                ";

        return $content;
    }
}