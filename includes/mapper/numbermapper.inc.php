<?php
/**
 * Created by PhpStorm.
 * User: Elli
 * Date: 8/31/2016
 * Time: 12:48 PM
 */

require_once ('datamapper.inc.php');

class NumberMapper extends DataMapper{

    public static function add($number){
        $st = self::$db->prepare("
        INSERT INTO Number SET 
        Prefix = :Prefix,
        StartInt = :StartInt,
        EndInt = :EndInt,
        ");

        $st->execute(array(
            ':Prefix' => $number->getPrefix(),
            ':StartInt' => $number->getStartInt(),
            ':EndInt' => $number->getEndInt(),
        ));

        return self::$db->lastInsertId();
    }

    public static function delete($number)
    {
        self::$db->query("DELETE FROM Number WHERE ID=" . $number->getId());
    }

    public static function findById($id)
    {
        $query = self::$db->query("SELECT * FROM Number WHERE ID=" . $id);

        if($e = $query->fetch(PDO::FETCH_OBJ))
        {
            $Number = new Number();
            $Number->setId(intval($e->ID));
            $Number->setPrefix($e->Prefix);
            $Number->setStartInt($e->StartInt);
            $Number->setEndInt($e->EndInt);

            return $Number;
        } else
        {
            return null;
        }
    }


    public static function getAllNumbers()
    {
        $query = self::$db->query("SELECT * FROM Number");

        $numbers = array();

        while($e = $query->fetch(PDO::FETCH_OBJ))
        {
            $Number = new Number();
            $Number->setId(intval($e->ID));
            $Number->setPrefix($e->Prefix);
            $Number->setStartInt($e->StartInt);
            $Number->setEndInt($e->EndInt);

            $numbers[] = $Number;
        }

        if($query->rowCount() == 0)
            return null;
        else
            return $numbers;
    }

    public static function update($number)
    {
        $st = self::$db->prepare("
        UPDATE Number SET 
        Prefix = :Prefix,
        StartInt = :StartInt,
        EndInt = :EndInt,
        WHERE ID= :id
        ");

        $st->execute(array(
            ':Prefix' => $number->getPrefix(),
            ':StartInt' => $number->getStartInt(),
            ':EndInt' => $number->getEndInt(),
            ':id' => $number->getId()
        ));
    }
}
