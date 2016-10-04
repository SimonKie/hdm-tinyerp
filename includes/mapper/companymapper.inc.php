<?php

/**
 * Created by PhpStorm.
 * User: Elli
 * Date: 8/30/2016
 * Time: 4:45 PM
 */
require_once('datamapper.inc.php');

class CompanyMapper extends DataMapper
{
    public static function add($company){
        $st = self::$db->prepare("
        INSERT INTO Company SET 
        Name = :Name,
        Street = :Street,
        EMail = :EMail,
        ZIPCode = :ZIPCode,
        City = :City,
        Bank = :Bank,
        IBAN = :IBAN,
        BIC = :BIC,
        CEO = :CEO,
        Register = :Register,
        RegisterNr = :RegisterNr,
        VATID = :VATID
        ");
 
        $st->execute(array(
            ':Name' => $company->getName(),
            ':Street' => $company->getStreet(),
            ':EMail' => $company->getEMail(),
            ':ZIPCode' => intval($company->getZipCode()),
            ':City' => $company->getCity(),
            ':Bank' => $company->getBank(),
            ':IBAN' => $company->getIban(),
            ':BIC' => $company->getBic(),
            ':CEO' => $company->getCeo(),
            ':Register' => $company->getRegister(),
            ':RegisterNr' => $company->getRegisterNr(),
            ':VATID' => $company->getVatid()
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
            $Company->setZipCode(intval($e->ZIPCode));
            $Company->setCity($e->City);
            $Company->setEMail($e->EMail);
            $Company->setBank($e->Bank);
            $Company->setIban($e->IBAN);
            $Company->setBic($e->BIC);
            $Company->setCeo($e->CEO);
            $Company->setRegister($e->Register);
            $Company->setRegisterNr($e->RegisterNr);
            $Company->setVatid($e->VATID);
          
            return $Company;
        } else
        {
            return null;
        }
    }


    public static function getAllCompanies()
    {
        $query = self::$db->query("SELECT * FROM Company");

        $Companies = array();

        WHILE($e = $query->fetch(PDO::FETCH_OBJ))
        {

            $Company = new Company();
            $Company->setId(intval($e->ID));
            $Company->setName($e->Name);
            $Company->setStreet($e->Street);
            $Company->setZipCode(intval($e->ZIPCode));
            $Company->setCity($e->City);
            $Company->setEMail($e->EMail);
            $Company->setBank($e->Bank);
            $Company->setIban($e->IBAN);
            $Company->setBic($e->BIC);
            $Company->setCeo($e->CEO);
            $Company->setRegister($e->Register);
            $Company->setRegisterNr($e->RegisterNr);
            $Company->setVatid($e->VATID);
            $Companies[] = $Company;
        }

        if($query->rowCount() == 0)
            return null;
        else
            return $Companies;
    }

    public static function update($company)
    {
        $st = self::$db->prepare("
        UPDATE Company SET 
        Name = :Name,
        Street = :Street,
        EMail = :EMail,
        ZIPCode = :ZIPCode,
        City = :City,
        Bank = :Bank,
        IBAN = :IBAN,
        BIC = :BIC,
        CEO = :CEO,
        Register = :Register,
        RegisterNr = :RegisterNr,
        VATID = :VATID
        WHERE ID= :id
        ");

        $st->execute(array(
            ':Name' => $company->getName(),
            ':Street' => $company->getStreet(),
            ':EMail' => $company->getEMail(),
            ':ZIPCode' => $company->getZipCode(),
            ':City' => $company->getCity(),
            ':Bank' => $company->getBank(),
            ':IBAN' => $company->getIban(),
            ':BIC' => $company->getBic(),
            ':CEO' => $company->getCeo(),
            ':Register' => $company->getRegister(),
            ':RegisterNr' => $company->getRegisterNr(),
            ':VATID' => $company->getVatid(),
            ':id' => $company->getId()
        ));

        return self::$db->lastInsertId();
    }


}