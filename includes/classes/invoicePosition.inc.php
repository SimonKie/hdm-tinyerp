
<?php

/**
 * Created by PhpStorm.
 * User: Elli
 * Date: 8/30/2016
 * Time: 12:56 PM
 */
class invoicePosition
{

    private $qty;
    private $price;
    private $invoice;

    /**
     * invoicePosition constructor.
     * @param $invoice
     * @param $price
     * @param $qty
     */
    public function __construct($qty, $invoice, $price)
    {
        $this->invoice = $invoice;
        $this->price = $price;
        $this->qty = $qty;
    }

    /**
     * @return mixed
     */
    public function getInvoice()
    {
        return $this->invoice;
    }

    /**
     * @param mixed $invoice
     */
    public function setInvoice($invoice)
    {
        $this->invoice = $invoice;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @return mixed
     */
    public function getQty()
    {
        return $this->qty;
    }

    /**
     * @param mixed $qty
     */
    public function setQty($qty)
    {
        $this->qty = $qty;
    }


    //Wie schreibt man das richtig? Wofuer braucht man daS?
    public static function getDropdown($invoicePosition)
    {
        $content = "
        <select name=\"Rechnungsposition\">
        <option selected value=\"null\">&nbsp;</option> ";

        foreach ($invoicePosition as $i)
        {
            $content .= "<option value=\"" . $i->getInvoice() . "\">" . $i->getprice() . "</option>\n";
        }

        $content .= "</select>";

        return $content;
    }
    
    

}