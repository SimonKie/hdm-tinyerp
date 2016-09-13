<?php

/**
 * Created by PhpStorm.
 * User: Elli
 * Date: 8/30/2016
 * Time: 12:39 PM
 */

class Product
{
    private $id = null;
    private $price;
    private $vat;
    private $number;
    private $productCategory;


    public function __construct()
    {
    }

    public function __construct1($price,$vat,$number, $productCategory)
    {
        $this->price = $price;
        $this->vat = $vat;
        $this->number = $number;
        $this->productCategory = $productCategory;
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
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @param mixed $number
     */
    public function setNumber($number)
    {
        $this->number = $number;
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
    public function getVat()
    {
        return $this->vat;
    }

    /**
     * @param mixed $vat
     */
    public function setVat($vat)
    {
        $this->vat = $vat;
    }

    /**
     * @return mixed
     */
    public function getProductCategory()
    {
        return $this->productCategory;
    }

    /**
     * @param mixed $productCategory
     */
    public function setProductCategory($productCategory)
    {
        $this->productCategory = $productCategory;
    }

    public function listObject()
    {
        $return = '
        <h6>' . $this->getNumber() . '</h6>
        <p>Kategorie: ' . $this->getProductCategory() . 'Preis: ' . $this->getPrice(). 'MwSt: '. $this->getVat().'
        <a href="">bearbeiten</a> | <a href="">löschen</a>
        </p>        
        ';

        return $return;
    }

    public static function formMapper($post)
    {
        $Product = new Product();

        $Product->setNumber($post['number']);
        

        if(is_numeric($post['price']))

            $Product->setPrice(floatval($post['price']));
        else
            return "Falscher Preis.";

        return $Product;
    }
    
    public static function getForm(Product $product = null)
    {
        $productId = '';
        $number = '';
        $price = '';
        

        if($product == null) {
            $hidden = "new";
        }
        else {
            $hidden = "update";
            $productId = $product->getId();
            $price = $product->getPrice();
            $number = $product->getNumber();
        }


        return "
            <div class=\"form-style-1\">
            <form action=\"?id=2\" method=\"POST\">
            <input type=\"hidden\" name=\"action\" value=\"$hidden\" />
            <input type=\"hidden\" name=\"productId\" value=\"$productId\" />
            <label for=\"name\"><span>Nummer<span class=\"required\">*</span></span> 
              <input type=\"text\" class=\"input-field\" name=\"number\" value=\"$number\" maxlength=\"100\" placeholder=\"12345\" required/>
            </label>
            <label for=\"name\"><span>Preis<span class=\"required\">*</span></span> 
              <input type=\"text\" class=\"input-field\" name=\"price\" value=\"$price\" maxlength=\"100\" placeholder=\"100.00\" required />
            </label>
            
            <label><span>&nbsp;</span><input type=\"submit\" value=\"speichern\" /></label>
            
            </form>
            </div>
        ";
    }
    
    public static function getDropdown($product)
    {
        $content = "
        <select class='dropdown' name=\"Produkte\">
        <option selected value=\"null\">&nbsp;</option> ";

        foreach ($product as $p)
        {
            $content .= "<option value=\"" . $p->getId() . "\">" . $p->getNumber() ."</option>\n";
        }

        $content .= "</select>";

        return $content;
    }

    



}