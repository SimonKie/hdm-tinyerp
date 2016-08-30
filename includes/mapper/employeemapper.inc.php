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

    public static function add($employee){
        $st = self::$db->prepare("
        INSERT INTO Employee SET 
        FirstName = :FirstName,
        LastName = :LastName,
        EMail = :EMail,
        Phone = :Phone
        ");

        $st->execute(array(
            ':FirstName' => $employee->getFirstName(),
            ':LastName' => $employee->getLastName(),
            ':EMail' => $employee->getEMail(),
            ':Phone' => $employee->getPhone()
        ));

        return self::$db->lastInsertId();
    }

    public static function delete($employee)
    {
        self::$db->query("DELETE FROM Employee WHERE ID=" . $employee->getId());
    }

    public static function findById($id)
    {
        $query = self::$db->query("SELECT * FROM Employee WHERE ID=" . $id);

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


    public static function getAllEmployees()
    {
        $query = self::$db->query("SELECT * FROM Employee");

        $employees = array();

        while($e = $query->fetch(PDO::FETCH_OBJ))
        {
            $Employee = new Employee();
            $Employee->setId(intval($e->ID));
            $Employee->setFirstName($e->FirstName);
            $Employee->setLastName($e->LastName);
            $Employee->setEMail($e->EMail);
            $Employee->setPhone($e->Phone);

            $employees[] = $Employee;
        }

        if($query->rowCount() == 0)
            return null;
        else
            return $employees;
    }

    public static function update($employee)
    {
        $st = self::$db->prepare("
        UPDATE Employee SET 
        FirstName = :FirstName,
        LastName = :LastName,
        EMail = :EMail,
        Phone = :Phone,
        WHERE ID= :id
        ");

        $st->execute(array(
            ':FirstName' => $employee->getFirstName(),
            ':LastName' => $employee->getLastName(),
            ':EMail' => $employee->getEMail(),
            ':Phone' => $employee->getPhone(),
            ':id' => $employee->getId()
        ));
    }
}