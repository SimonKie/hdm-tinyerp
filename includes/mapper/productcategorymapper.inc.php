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
        $query = self::$db->query("SELECT * FROM ProductCategory WHERE ID=" . $id);

        if($p = $query->fetch(PDO::FETCH_OBJ))
        {
            $productCategory = new ProductCategory();
            $productCategory->setId(intval($p->ID));
            $productCategory->setName($p->Name);
            $productCategory->setDescription($p->Description);
            return $productCategory;
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
        $query = self::$db->query("SELECT * FROM ProductCategory ORDER BY Name");

        $productCategories = array();

        while($p = $query->fetch(PDO::FETCH_OBJ))
        {
            $productCategory = new ProductCategory();
            $productCategory->setId(intval($p->ID));
            $productCategory->setName($p->Name);
            $productCategory->setDescription($p->Description);

            $productCategories[] = $productCategory;
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
            WHERE ID = :id
          ");

        $st->execute(array(
            ':Name' => $productCategory->getName(),
            ':Description' => $productCategory->getDescription(),
            ':id' => $productCategory->getId()
        ));

        return self::$db->lastInsertId();
    }
}