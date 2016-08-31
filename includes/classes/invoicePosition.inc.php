
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
    private $sort;
    private $invoice;
    private $product;

    /**
     * invoicePosition constructor.
     * @param $qty
     * @param $price
     * @param $sort
     * @param $invoice
     * @param $product
     */
    public function __construct($qty, $price, $sort, $invoice, $product)
    {
        $this->qty = $qty;
        $this->price = $price;
        $this->sort = $sort;
        $this->invoice = $invoice;
        $this->product = $product;
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

    /**
     * @return mixed
     */
    public function getSort()
    {
        return $this->sort;
    }

    /**
     * @param mixed $sort
     */
    public function setSort($sort)
    {
        $this->sort = $sort;
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


    //Wie schreibt man das richtig? Wofuer braucht man daS?
    public static function getDropdown($invoicePosition)
    {
        $content = "
        <select class='dropdown' name=\"Rechnungsposition\">
        <option selected value=\"null\">&nbsp;</option> ";

        foreach ($invoicePosition as $i)
        {
            $content .= "<option value=\"" . $i->getInvoice() . "\">" . $i->getPrice() . "</option>\n";
        }

        $content .= "</select>";

        return $content;
    }
    
    

}