<?php

/**
 * Created by PhpStorm.
 * User: Elli
 * Date: 8/23/2016
 * Time: 11:53 AM
 */

require_once('dataMapper.inc.php');


class EmployeeMapper extends DataMapper
{

    public static function add($Employee){
        $st = self::$db->prepare("
        insert into Employee set 
        FirstName = :FirstName,
        LastName = :LastName,
        EMail = :EMail,
        Phone = :Phone
        ");

        $st->execute(array(
            ':FirstName' => $Employee->getFirstName(),
            ':LastName' => $Employee->getLastName(),
            ':EMail' => $Employee->getEMail(),
            ':Phone' => $Employee->getPhone()
        ));

        return self::$db->lastInsertId();
    }

    public static function delete($Employee)
    {
        self::$db->query("delete from Employee where ID=" . $Employee->getId());
    }

    public static function findbyid($id)
    {
        $query = self::$db->query("select * from Employee where ID=" . $id);

        if($e = $query->fetch(PDO::FETCH_OBJ))
        {
            
            $Employee = new Employee();
            $Employee->setId(intval($e->ID));
            $Employee->setFirstName($e->FirstName);
            $Employee->setLastName($e->LastName);
            $Employee->setEMail($e->EMail);
            $Employee->setPhone($e->Phone);

            return $Employee;
        } else
        {
            return null;
        }
    }


    public static function getallEmployees()
    {
        $query = self::$db->query("select * from employee");

        $Employees = array();

        while($e = $query->fetch(PDO::FETCH_OBJ))
        {
            $Employee = new Employee();
            $Employee->setId(intval($e->ID));
            $Employee->setFirstName($e->FirstName);
            $Employee->setLastName($e->LastName);
            $Employee->setEMail($e->EMail);
            $Employee->setPhone($e->Phone);

            $Employees[] = $Employee;
        }

        if($query->rowCount() == 0)
            return null;
        else
            return $Employees;
    }

    public static function update($Employee)
    {
        $st = self::$db->prepare("
        update employee set 
        FirstName = :FirstName,
        LastName = :LastName,
        EMail = :EMail,
        Phone = :Phone,
        WHERE ID= :id
        ");

        $st->execute(array(
            ':FirstName' => $Employee->getFirstName(),
            ':LastName' => $Employee->getLastName(),
            ':EMail' => $Employee->getEMail(),
            ':Phone' => $Employee->getPhone(),
            ':id' => $Employee->getId()
        ));
    }
}