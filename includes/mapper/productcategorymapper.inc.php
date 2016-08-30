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
     * @param $ProductCategory
     * @return $id
     */
    public static function add($ProductCategory)
    {
        $st = self::$db->prepare("
            insert into productcategory SET 
            Name = :Name,
            Description = :Description
            ");

        $st->execute(array(
            ':Name' => $ProductCategory->getName(),
            ':Description' => $ProductCategory->getDescription()
        ));

        return self::$db->lastInsertId();
    }

    /**
     * @param ProductCategory:$VAT
     */
    public static function delete($ProductCategory)
    {
        self::$db->query("delete from productcategory where ID=" . $ProductCategory->getId());
    }
    
    public static function findbyid($id)
    {
        $query = self::$db->query("select from productcategory where ID=" . $id);
        
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
    public static function getallProductCategories()
    {
        $query = self::$db->query("select * from productcategory");

        $ProductCategories = array();

        while($p = $query->fetch(PDO::FETCH_OBJ))
        {
            $ProductCategory = new ProductCategory();
            $ProductCategory->setId(intval($p->ID));
            $ProductCategory->setName($p->Name);
            $ProductCategory->setDescription($p->Description);

            $ProductCategories[] = $ProductCategory;
        }

        if($query->rowCount() == 0)
            return null;
        else
            return $ProductCategories;
    }

    public static function update($ProductCategory)
    {
        $st = self::$db->prepare("
            update productcategory SET 
            Name = :Name,
            Description = :Description
            where ID = :ID"
        );

        $st->execute(array(
            ':Name' => $ProductCategory->getName(),
            ':Description' => $ProductCategory->getDescription(),
            ':ID' => $ProductCategory->getId()
        ));

        return self::$db->lastInsertId();
    }
}