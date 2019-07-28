<?php

/**
 * InstitucionModel
 * This is basically a simple CRUD (Create/Read/Update/Delete) demonstration.
 */
class InstitucionModel
{
    /**
     * Get all instituciones (instituciones are just example data that the user has created)
     * @return array an array with several objects (the results)
     */
    public static function getAllInstituciones()
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "SELECT instituciones.user_id, users.user_name, instituciones.institucion_id, instituciones.institucion_text FROM instituciones INNER JOIN users ON instituciones.user_id = users.user_id";
        $query = $database->prepare($sql);
        $query->execute();

        // fetchAll() is the PDO method that gets all result rows
        return $query->fetchAll();
    }

    /**
     * Get a single institucion
     * @param int $institucion_id id of the specific institucion
     * @return object a single object (the result)
     */
    public static function getInstitucion($institucion_id)
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "SELECT instituciones.user_id, instituciones.institucion_id, users.user_name, instituciones.institucion_text FROM instituciones INNER JOIN users ON instituciones.user_id = users.user_id WHERE institucion_id = :institucion_id LIMIT 1";
        $query = $database->prepare($sql);
        $query->execute(array(':institucion_id' => $institucion_id));

        // fetch() is the PDO method that gets a single result
        return $query->fetch();
    }

    public static function getInstitucionJefe($user_id)
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "SELECT instituciones.user_id, instituciones.institucion_id FROM instituciones WHERE user_id = :user_id LIMIT 1";
        $query = $database->prepare($sql);
        $query->execute(array(':user_id' => $user_id));

        // fetch() is the PDO method that gets a single result
        return $query->fetch();
    }

    /**
     * Set a institucion (create a new one)
     * @param string $institucion_text institucion text that will be created
     * @return bool feedback (was the institucion created properly ?)
     */
    public static function createInstitucion($institucion_text, $user_id)
    {
        if (!$institucion_text || strlen($institucion_text) == 0) {
            Session::add('feedback_negative', Text::get('FEEDBACK_NOTE_CREATION_FAILED'));
            return false;
        }

        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "INSERT INTO instituciones (institucion_text, user_id) VALUES (:institucion_text, :user_id)";
        $query = $database->prepare($sql);
        $query->execute(array(':institucion_text' => $institucion_text, ':user_id' => $user_id));

        if ($query->rowCount() == 1) {
            return true;
        }

        // default return
        Session::add('feedback_negative', Text::get('FEEDBACK_NOTE_CREATION_FAILED'));
        return false;
    }

    /**
     * Update an existing institucion
     * @param int $institucion_id id of the specific institucion
     * @param string $institucion_text new text of the specific institucion
     * @return bool feedback (was the update successful ?)
     */
    public static function updateInstitucion($institucion_id, $institucion_text)
    {
        if (!$institucion_id || !$institucion_text) {
            return false;
        }

        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "UPDATE instituciones SET institucion_text = :institucion_text WHERE institucion_id = :institucion_id LIMIT 1";
        $query = $database->prepare($sql);
        $query->execute(array(':institucion_id' => $institucion_id, ':institucion_text' => $institucion_text));

        if ($query->rowCount() == 1) {
            return true;
        }

        Session::add('feedback_negative', Text::get('FEEDBACK_NOTE_EDITING_FAILED'));
        return false;
    }

    /**
     * Delete a specific institucion
     * @param int $institucion_id id of the institucion
     * @return bool feedback (was the institucion deleted properly ?)
     */
    public static function deleteInstitucion($institucion_id)
    {
        if (!$institucion_id) {
            return false;
        }

        self::removeAllUserInInstitucion($institucion_id);

        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "DELETE FROM instituciones WHERE institucion_id = :institucion_id LIMIT 1";
        $query = $database->prepare($sql);
        $query->execute(array(':institucion_id' => $institucion_id));

        if ($query->rowCount() == 1) {
            return true;
        }

        // default return
        Session::add('feedback_negative', Text::get('FEEDBACK_NOTE_DELETION_FAILED'));
        return false;
    }


    ////////////////////////////////////
    /////////////////////////////////////
    /////////////////////////////////////
    /////////////////////////////////////
    /////////////////////////////////////
    /////////////////////////////////////
    /////////////////////////////////////
    ////////////////////////////////////

    public static function getAllUsuariosIstitucionales()
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "SELECT inst_user.institucion_id, inst_user.user_id, users.user_name, users.user_email, roles.rol_name FROM inst_user INNER JOIN users ON inst_user.user_id = users.user_id INNER JOIN roles ON users.user_account_type = roles.rol_id";
        $query = $database->prepare($sql);
        $query->execute();

        // fetchAll() is the PDO method that gets all result rows
        return $query->fetchAll();
    }

    public static function getAllUsuariosIstitucionalesWhereInstitucion($institucion_id)
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "SELECT inst_user.institucion_id, inst_user.user_id, users.user_name, users.user_email FROM inst_user INNER JOIN users ON inst_user.user_id = users.user_id WHERE inst_user.institucion_id = :institucion_id";
        $query = $database->prepare($sql);
        $query->execute(array(':institucion_id'=> $institucion_id));

        // fetchAll() is the PDO method that gets all result rows
        return $query->fetchAll();
    }

    public static function getAllInstitucionesUser($user_id)
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "SELECT inst_user.institucion_id, instituciones.institucion_text FROM inst_user INNER JOIN instituciones ON inst_user.institucion_id = instituciones.institucion_id WHERE inst_user.user_id = :user_id";
        $query = $database->prepare($sql);
        $query->execute(array(':user_id' => $user_id));

        // fetchAll() is the PDO method that gets all result rows
        return $query->fetchAll();
    }

    public static function addUser($institucion_id, $user_id)
    {

        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "INSERT INTO inst_user (institucion_id, user_id) VALUES (:institucion_id, :user_id)";
        $query = $database->prepare($sql);
        $query->execute(array(':institucion_id' => $institucion_id, ':user_id' => $user_id));

        if ($query->rowCount() == 1) {
            return true;
        }

        // default return
        Session::add('feedback_negative', Text::get('FEEDBACK_NOTE_CREATION_FAILED'));
        return false;
    }

    public static function removeUser($institucion_id, $user_id)
    {
        if (!$institucion_id) {
            return false;
        }

        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "DELETE FROM inst_user WHERE institucion_id = :institucion_id AND user_id = :user_id LIMIT 1";
        $query = $database->prepare($sql);
        $query->execute(array(':institucion_id' => $institucion_id,':user_id' => $user_id));

        if ($query->rowCount() == 1) {
            return true;
        }

        // default return
        Session::add('feedback_negative', Text::get('FEEDBACK_NOTE_DELETION_FAILED'));
        return false;
    }

    public static function removeAllUserInInstitucion($institucion_id)
    {
        if (!$institucion_id) {
            return false;
        }

        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "DELETE FROM inst_user WHERE institucion_id = :institucion_id";
        $query = $database->prepare($sql);
        $query->execute(array(':institucion_id' => $institucion_id));

        if ($query->rowCount() > 0) {
            return true;
        }

        // default return
        return false;
    }
}
