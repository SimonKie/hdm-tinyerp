<?php
/**
 * Created by PhpStorm.
 * User: Elli
 * Date: 8/31/2016
 * Time: 1:24 PM
 */

require_once ('datamapper.inc.php');

class ProductMapper extends DataMapper{

    public static function add($product){
        $st = self::$db->prepare("
        INSERT INTO Product SET 
        Number = :Number,
        Price = :Price
        ");

        $st->execute(array(
            ':Number' => $product->getNumber(),
            ':Price' => $product->getPrice()
        ));

        return self::$db->lastInsertId();
    }

    public static function delete($product)
    {
        self::$db->query("DELETE FROM Product WHERE ID=" . $product->getId());
    }

    public static function findById($id)
    {
        $query = self::$db->query("SELECT * FROM Product WHERE ID=" . $id);

        if($e = $query->fetch(PDO::FETCH_OBJ))
        {
            $Product = new Product();
            $Product->setId(intval($e->ID));
            $Product->setNumber($e->Number);
            $Product->setPrice($e->Price);

            return $Product;
        } else
        {
            return null;
        }
    }


    public static function getAllProducts()
    {
        $query = self::$db->query("SELECT * FROM Product");

        $products = array();

        while($e = $query->fetch(PDO::FETCH_OBJ))
        {
            $Product = new Product();
            $Product->setId(intval($e->ID));
            $Product->setNumber($e->Number);
            $Product->setPrice($e->Price);

            $products[] = $Product;
        }

        if($query->rowCount() == 0)
            return null;
        else
            return $products;
    }

    public static function update($product)
    {
        $st = self::$db->prepare("
        UPDATE Product SET 
        Number = :Number,
        Price = :Price
        WHERE ID= :id
        ");

        $st->execute(array(
            ':Number' => $product->getNumber(),
            ':Price' => $product->getPrice(),
            ':id' => $product->getId()
        ));
    }
}

