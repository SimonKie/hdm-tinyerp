<?php
/**
 * Created by PhpStorm.
 * User: Elli
 * Date: 8/31/2016
 * Time: 1:38 PM
 */

require_once ('datamapper.inc.php');

class UserMapper extends DataMapper{

    public static function add($user){
        $st = self::$db->prepare("
        INSERT INTO User SET 
         Username = :Username,
        Password = :Password
        ");

        $st->execute(array(
            ':Username' => $user->getUsername(),
            ':Password' => $user->getPassword()
        ));

        return self::$db->lastInsertId();
    }

    public static function delete($username)
    {
        self::$db->query("DELETE FROM User WHERE ID=" . $username->getId());
    }

    public static function findById($id)
    {
        $query = self::$db->query("SELECT * FROM User WHERE ID=" . $id);

        if($e = $query->fetch(PDO::FETCH_OBJ))
        {
            $User = new User();
            $User->setId(intval($e->ID));
            $User->setUsername($e->Username);
            $User->setPassword($e->Password);
            $User->setUserRole(UserMapper::findById(intval($e->UserRole_ID)));
            return $User;
        } else
        {
            return null;
        }
    }

    public static function getAllUsers()
    {
        $query = self::$db->query("SELECT * FROM User");

        $users = array();

        while($e = $query->fetch(PDO::FETCH_OBJ))
        {
            $User = new User();
            $User->setId(intval($e->ID));
            $User->setUsername($e->Username);
            $User->setPassword($e->Password);
            $User->setUserRole(UserMapper::findById(intval($e->UserRole_ID)));
            $users[] = $User;
        }

        if($query->rowCount() == 0)
            return null;
        else
            return $users;
    }

    public static function update($user)
    {
        $st = self::$db->prepare("
        UPDATE User SET 
        Username = :Username,
        Password = :Password
        WHERE ID= :id
        ");

        $st->execute(array(
            ':Username' => $user->getUsername(),
            ':Password' => $user->getPassword(),
            ':id' => $user->getId()
        ));
    }
}