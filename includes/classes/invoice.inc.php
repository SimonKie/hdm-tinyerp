<?php

/**
 * Created by PhpStorm.
 * User: Daniel
 * Date: 18.08.2016
 * Time: 14:51
 */
class Invoice
{
    private $id = null;
    private $customer;
    private $employee;
    private $product;
    private $invoiceNr;
    private $text;
    private $date;
    private $state;

    /*private $product sollte doch eher private $invoicePosition sein?!?*/


    /**
     * Invoice constructor.
     * @param null $id
     * @param $customer
     * @param $employee
     * @param $product
     * @param $invoiceNr
     * @param $text
     * @param $date
     * @param $state
     */

    public function __construct()
    {
    }


    public function __construct1($customer, $employee, $product, $invoiceNr, $text, $date, $state)
    {
        $this->customer = $customer;
        $this->employee = $employee;
        $this->product = $product;
        $this->invoiceNr = $invoiceNr;
        $this->text = $text;
        $this->date = $date;
        $this->state = $state;
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
    public function getCustomer()
    {
        return $this->customer;
    }

    /**
     * @param mixed $customer
     */
    public function setCustomer($customer)
    {
        $this->customer = $customer;
    }

    /**
     * @return mixed
     */
    public function getEmployee()
    {
        return $this->employee;
    }

    /**
     * @param mixed $employee
     */
    public function setEmployee($employee)
    {
        $this->employee = $employee;
    }

    /**
     * @return mixed
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * @param mixed $product
     */
    public function setProduct($product)
    {
        $this->product = $product;
    }

    /**
     * @return mixed
     */
    public function getInvoiceNr()
    {
        return $this->invoiceNr;
    }

    /**
     * @param mixed $invoiceNr
     */
    public function setInvoiceNr($invoiceNr)
    {
        $this->invoiceNr = $invoiceNr;
    }

    /**
     * @return mixed
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param mixed $text
     */
    public function setText($text)
    {
        $this->text = $text;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @return mixed
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @param mixed $state
     */
    public function setState($state)
    {
        $this->state = $state;
    }

    public function listObject()
    {
        $return = '
        <h6>' . $this->getInvoiceNr() . '</h6>
        <p>Produkt: ' . $this->getProduct() . 'Status: ' . $this->getState(). 'Text: ' . $this->getText() .
            'Kunde: ' . $this->getCustomer() . 'Datum: ' . $this->getDate(). 'Mitarbeiter: '. $this->getEmployee().'
        <a href="">bearbeiten</a> | <a href="">löschen</a>
        </p>        
        ';

        return $return;
    }

    public static function getDropdown($invoice)
    {
        $content = "
        <select class='dropdown' name=\"Rechnung\">
        <option selected value=\"null\">&nbsp;</option> ";

        foreach ($invoice as $i)
        {
            $content .= "<option value=\"" .$i->getId()."\">" .$i->getCustomer()."\">" .$i->getCompany()."</option>\n";
        }

        $content .= "</select>";

        return $content;
    }

}