<?php

/**
 * Created by PhpStorm.
 * User: Elli
 * Date: 8/30/2016
 * Time: 4:45 PM
 */
require_once('dataMapper.inc.php');

class companymapper extends DataMapper
{
    public static function add($company){
        $st = self::$db->prepare("
        INSERT INTO Company SET 
        Name = :Name,
        Street = :Street,
        EMail = :EMail,
        ZipCode = :ZipCode,
        City = :City,
        EMail = :EMail,
        Bank = :Bank,
        IBAN = :IBAN,
        BIC = :BIC,
        CEO = :CEO,
        Register = :Register,
        RegisterNr = :RegisterNr,
        VATID = :VATID,
        ");
 
        $st->execute(array(
            ':Name' => $company->getName(),
            ':Street' => $company->getStreet(),
            ':EMail' => $company->getEMail(),
            ':ZipCode' => $company->getZipCode(),
            ':City' => $company->getCity(),
            ':Bank' => $company->getBank(),
            ':IBAN' => $company->getIban(),
            ':BIC' => $company->getBic(),
            ':Register' => $company->getRegister(),
            ':RegisterNr' => $company->getRegisterNr(),
            ':VATID' => $company->getVatid(),
        ));

        return self::$db->lastInsertId();
    }

    public static function delete($company)
    {
        self::$db->query("DELETE FROM Company WHERE ID=" . $company->getId());
    }

    public static function findbyid($id)
    {
        $query = self::$db->query("SELECT * FROM Company WHERE ID=" . $id);

        if($e = $query->fetch(PDO::FETCH_OBJ))
        {

            $Company = new Company();
            $Company->setId(intval($e->ID));
            $Company->setName($e->Name);
            $Company->setStreet($e->Street);
            $Company->setZIPCode($e->zipCode);
            $Company->setCity($e->City);
            $Company->setEMail($e->EMail);
            $Company->setBank($e->Bank);
            

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