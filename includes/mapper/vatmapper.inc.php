<?php
/**
 * Created by PhpStorm.
 * User: Daniel
 * Date: 22.08.2016
 * Time: 21:58
 */

require_once('datamapper.inc.php');

class VATMapper extends DataMapper
{
    /**
     * @param $vat:$VAT
     * @return integer|$id
     */
    public static function add($vat)
    {
        $st = self::$db->prepare("
        INSERT INTO VAT SET 
        Value = :Value,
        Description = :Description,
        StartDate = :StartDate,
        EndDate = :EndDate
        ");

        $st->execute(array(
            ':Value' => $vat->getValue(),
            ':Description' => $vat->getDescription(),
            ':StartDate' => $vat->getStartDate(),
            ':EndDate' => $vat->getEndDate()
        ));

        return self::$db->lastInsertId();
    }

    /**
     * @param $vat:$VAT
     */
    public static function delete($vat)
    {
        self::$db->query("DELETE FROM VAT WHERE ID=" . $vat->getid());
    }

    /**
     * @param integer:$id
     * @return bool|VAT
     */
    public static function findById($id)
    {
        $query = self::$db->query("SELECT * FROM VAT WHERE ID=" . $id);

        if($v = $query->fetch(PDO::FETCH_OBJ))
        {
            $VAT = new VAT();
            $VAT->setId(intval($v->ID));
            $VAT->setValue(floatval($v->Value));
            $VAT->setDescription($v->Description);
            $VAT->setStartDate(strtotime($v->StartDate));
            $VAT->setEndDate(strtotime($v->EndDate));

            return $VAT;
        } else
        {
            return null;
        }
    }

    /**
     * @return VAT:array
     */
    public static function getAllVats()
    {
        $query = self::$db->query("SELECT * FROM VAT");

        $vats = array();

        while($v = $query->fetch(PDO::FETCH_OBJ))
        {
            $VAT = new VAT();
            $VAT->setId(intval($v->ID));
            $VAT->setValue(floatval($v->Value));
            $VAT->setDescription($v->Description);
            $VAT->setStartDate(strtotime($v->StartDate));
            $VAT->setEndDate(strtotime($v->EndDate));

            $vats[] = $VAT;
        }

        if($query->rowCount() == 0)
            return null;
        else
            return $vats;
    }

    public static function update($vat)
    {
        $st = self::$db->prepare("
        UPDATE VAT SET 
        Value = :Value,
        Description = :Description,
        StartDate = :StartDate,
        EndDate = :EndDate,
        WHERE ID= :id
        ");

        $st->execute(array(
            ':Value' => $vat->getValue(),
            ':Description' => $vat->getDescription(),
            ':StartDate' => $vat->getStartDate(),
            ':EndDate' => $vat->getEndDate(),
            ':id' => $vat->getId()
        ));
    }
}