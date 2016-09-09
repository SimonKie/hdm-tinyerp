<?php
/**
 * Created by PhpStorm.
 * User: Simon
 * Date: 31.08.2016
 * Time: 13:40
 */

require_once('datamapper.inc.php');

class UserRoleMapper extends DataMapper
{
    public static function add($userRole){
        $st = self::$db->prepare("
        INSERT INTO UserRole SET 
        Name = :Name
        ");

        $st->execute(array(
            ':Name' => $userRole->getName()
        ));

        return self::$db->lastInsertId();
    }

    public static function delete($userRole)
    {
        self::$db->query("DELETE FROM UserRole WHERE ID=" . $userRole->getId());
    }

    public static function findbyid($id)
    {
        $query = self::$db->query("SELECT * FROM UserRole WHERE ID=" . $id);

        if($e = $query->fetch(PDO::FETCH_OBJ))
        {

            $userRole = new UserRole();
            $userRole->setId(intval($e->ID));
            $userRole->setName($e->Name);

            return $userRole;
        } else
        {
            return null;
        }
    }


    public static function getAllUserRoles()
    {
        $query = self::$db->query("SELECT * FROM UserRole");

        $userRoles = array();

        WHILE($e = $query->fetch(PDO::FETCH_OBJ))
        {

            $userRole = new UserRole();
            $userRole->setId(intval($e->ID));
            $userRole->setName($e->Name);
            $userRoles[] = $userRole;
        }

        if($query->rowCount() == 0)
            return null;
        else
            return $userRoles;
    }

    public static function update($userRole)
    {
        $st = self::$db->prepare("
        UPDATE UserRole SET 
        Name = :Name
        WHERE ID= :ID
        ");

        $st->execute(array(
            ':Name' => $userRole->getName(),
            ':ID' => $userRole->getId()
        ));
    }


}