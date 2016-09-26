<?php

/**
 * Created by PhpStorm.
 * User: Heike
 * Date: 30.08.2016
 * Time: 16:36
 */

require_once('datamapper.inc.php');


class CustomerMapper extends DataMapper
{

    public static function add($customer){
        $st = self::$db->prepare("
        INSERT INTO Customer set 
        CompanyName = :CompanyName,
        FirstName = :FirstName,
        LastName = :LastName,
        Street = :Street,
        ZIPCode = :ZIPCode,
        City = :City,
        EMail = :EMail,
        Phone = :Phone
        ");

        $st->execute(array(
            ':CompanyName' => $customer->getCompanyName(),
            ':FirstName' => $customer->getFirstName(),
            ':LastName' => $customer->getLastName(),
            ':Street' => $customer->getStreet(),
            ':ZIPCode' => $customer->getZIPCompany(),
            ':City' => $customer->getCity(),
            ':EMail' => $customer->getEMail(),
            ':Phone' => $customer->getPhone()
        ));

        return self::$db->lastInsertId();
    }

    public static function delete($customer)
            {
        self::$db->query("delete from Customer where ID=" . $customer->getId());
    }

    public static function findById($id)
    {
        $query = self::$db->query("SELECT * FROM Customer WHERE ID=" . $id);

        if($e = $query->fetch(PDO::FETCH_OBJ))
        {
            $customer = new Customer();
            $customer->setId(intval($e->ID));
            $customer->setCompanyName($e->CompanyName);
            $customer->setFirstName($e->FirstName);
            $customer->setLastName($e->LastName);
            $customer->setStreet($e->Street);
            $customer->setZipCode($e->ZIPCode);
            $customer->setCity($e->City);
            $customer->setEMail($e->EMail);
            $customer->setPhone($e->Phone);

            return $customer;
        } else
        {
            return null;
        }
    }


    public static function getAllCustomers()
    {
        $query = self::$db->query("SELECT * FROM Customer");

        $customer = array();

        while($e = $query->fetch(PDO::FETCH_OBJ))
        {
            $customer = new Customer();
            $customer->setId(intval($e->ID));
            $customer->setCompanyName($e->CompanyName);
            $customer->setFirstName($e->FirstName);
            $customer->setLastName($e->LastName);
            $customer->setStreet($e->Street);
            $customer->setZipCode($e->ZIPCode);
            $customer->setCity($e->City);
            $customer->setEMail($e->EMail);
            $customer->setPhone($e->Phone);

            $customer[] = $customer;
        }

        if($query->rowCount() == 0)
            return null;
        else
            return $customer;
    }

    public static function update($customer)
    {
        $st = self::$db->prepare("
        UPDATE Customer SET 
        CompanyName = :CompanyName,
        FirstName = :FirstName,
        LastName = :LastName,
        Street = :Street,
        ZIPCode = :ZIPCode,
        City = :City,
        EMail = :EMail,
        Phone = :Phone
        WHERE ID = :id
        ");

        $st->execute(array(
            ':CompanyName' => $customer->getCompanyName(),
            ':FirstName' => $customer->getFirstName(),
            ':LastName' => $customer->getLastName(),
            ':Street' => $customer->getStreet(),
            ':ZIPCode' => $customer->getZIPCompany(),
            ':City' => $customer->getCity(),
            ':EMail' => $customer->getEMail(),
            ':Phone' => $customer->getPhone(),
            ':id' => $customer->getId()
        ));
    }
}