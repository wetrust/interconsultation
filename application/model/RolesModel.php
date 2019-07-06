<?php

class RolesModel
{
    public static function getAllRoles()
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "SELECT rol_id, rol_name FROM roles";
        $query = $database->prepare($sql);
        $query->execute();

        // fetchAll() is the PDO method that gets all result rows
        return $query->fetchAll();
    }
}
