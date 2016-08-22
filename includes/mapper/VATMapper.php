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
     * @param $VAT - Object VAT
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

    public static function delete($VAT)
    {
        self::$db->query("delete from VAT where ID=" . $VAT->getid);
    }

    public static function findbyid($id)
    {
        $query = self::$db->query("select * from VAT where ID=" . $id);

        if($v = $query->fetch(PDO::FETCH_OBJ))
        {
            $VAT = new VAT();
            $VAT->setId($v->ID);
            $VAT->setValue($v->Value);
            $VAT->setDescription($v->Description);
            $VAT->setStartDate($v->StartDate);
            $VAT->setEndDate($v->EndDate);

            return $VAT;
        } else
        {
            return false;
        }
    }
}