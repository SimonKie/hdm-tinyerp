<?php

/**
 * Created by PhpStorm.
 * User: Daniel
 * Date: 24.08.2016
 * Time: 16:34
 */

require_once('datamapper.inc.php');

class ProductCategoryMapper extends DataMapper
{
    /**
     * @param $productCategory
     * @return $id
     */
    public static function add($productCategory)
    {
        $st = self::$db->prepare("
            INSERT INTO ProductCategory SET 
            Name = :Name,
            Description = :Description
            ");

        $st->execute(array(
            ':Name' => $productCategory->getName(),
            ':Description' => $productCategory->getDescription()
        ));

        return self::$db->lastInsertId();
    }

    /**
     * @param $productCategory:$VAT
     */
    public static function delete($productCategory)
    {
        self::$db->query("DELETE FROM ProductCategory WHERE ID=" . $productCategory->getId());
    }
    
    public static function findById($id)
    {
        $query = self::$db->query("SELECT FROM ProductCategory WHERE ID=" . $id);
        
        if($p = $query->fetch(PDO::FETCH_OBJ))
        {
            $ProductCategory = new ProductCategory();
            $ProductCategory->setId(intval($p->ID));
            $ProductCategory->setName($p->Name);
            $ProductCategory->setDescription($p->Description);
            return $ProductCategory;
        } else
        {
            return null;
        }
    }

    /**
     * @return ProductCategory:array
     */
    public static function getAllProductCategories()
    {
        $query = self::$db->query("SELECT * FROM ProductCategory");

        $productCategories = array();

        while($p = $query->fetch(PDO::FETCH_OBJ))
        {
            $ProductCategory = new ProductCategory();
            $ProductCategory->setId(intval($p->ID));
            $ProductCategory->setName($p->Name);
            $ProductCategory->setDescription($p->Description);

            $productCategories[] = $ProductCategory;
        }

        if($query->rowCount() == 0)
            return null;
        else
            return $productCategories;
    }

    public static function update($productCategory)
    {
        $st = self::$db->prepare("
            UPDATE ProductCategory SET 
            Name = :Name,
            Description = :Description
            WHERE ID = :ID"
        );

        $st->execute(array(
            ':Name' => $productCategory->getName(),
            ':Description' => $productCategory->getDescription(),
            ':ID' => $productCategory->getId()
        ));

        return self::$db->lastInsertId();
    }
}