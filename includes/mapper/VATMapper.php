<?php
/**
 * Created by PhpStorm.
 * User: Daniel
 * Date: 22.08.2016
 * Time: 21:58
 */

require_once('DataMapper.php');
require_once('../classes/VAT.php');

class VATMapper extends DataMapper
{
    /**
     * @param VAT:$VAT
     * @return integer|$id
     */
    public function add($VAT)
    {
        $st = self::$db->prepare("
        insert into VAT set 
        Value = :Value,
        Description = :Description,
        StartDate = :StartDate,
        EndDate = :EndDate
        ");

        $st->execute(array(
            ':Value' => $VAT->getValue(),
            ':Description' => $VAT->getDescription(),
            ':StartDate' => $VAT->getStartDate(),
            ':EndDate' => $VAT->getEndDate()
        ));

        return self::$db->lastInsertId();
    }

    /**
     * @param VAT:$VAT
     */
    public static function delete($VAT)
    {
        self::$db->query("delete from VAT where ID=" . $VAT->getid);
    }

    /**
     * @param integer:$id
     * @return bool|VAT
     */
    public static function findbyid($id)
    {
        $query = self::$db->query("select * from VAT where ID=" . $id);

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
            return false;
        }
    }

    /**
     * @return VAT:array
     */
    public static function getallVATs()
    {
        $query = self::$db->query("select * from VAT");

        $VATs = array();

        while($v = $query->fetch(PDO::FETCH_OBJ))
        {
            $VAT = new VAT();
            $VAT->setId(intval($v->ID));
            $VAT->setValue(floatval($v->Value));
            $VAT->setDescription($v->Description);
            $VAT->setStartDate(strtotime($v->StartDate));
            $VAT->setEndDate(strtotime($v->EndDate));

            $VATs[] = $VAT;
        }

        if(array_count_values($VATs) == 0)
            return false;
        else
            return $VATs;
    }

    public function update($VAT)
    {
        $st = self::$db->prepare("
        update VAT set 
        Value = :Value,
        Description = :Description,
        StartDate = :StartDate,
        EndDate = :EndDate,
        WHERE ID= :id
        ");

        $st->execute(array(
            ':Value' => $VAT->getValue(),
            ':Description' => $VAT->getDescription(),
            ':StartDate' => $VAT->getStartDate(),
            ':EndDate' => $VAT->getEndDate(),
            ':id' => $VAT->getId()
        ));

        return self::$db->lastInsertId();
    }
}