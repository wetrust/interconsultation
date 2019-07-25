<?php

class InterconsultasModel
{

    public static function getAllInterconsultas()
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "SELECT * FROM solicitudes WHERE solicitud_estado NOT IN (3,4)";
        $query = $database->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }

    public static function getAllInterconsultasEcografista()
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "SELECT * FROM solicitudes WHERE solicitud_estado NOT IN (1,3)";
        $query = $database->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }

    public static function getInterconsulta($solicitud_id)
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "SELECT * FROM solicitudes INNER JOIN users ON solicitudes.user_id = users.user_id WHERE solicitud_id = :solicitud_id";
        $query = $database->prepare($sql);
        $query->execute(array(":solicitud_id" => $solicitud_id));

        return $query->fetch();
    }

    public static function createInterconsulta($datos)
    {
        if (!$datos) {
            Session::add('feedback_negative', Text::get('FEEDBACK_NOTE_CREATION_FAILED'));
            return false;
        }

        $database = DatabaseFactory::getFactory()->getConnection();

        $sqlA = "INSERT INTO solicitudes (";$sqlB = "";$sqlC = ") VALUES (";$sqlD = "";$sqlF = ")";

        foreach($datos as $clave => $valor) {
            //necesito remover los : de la cadena clave ej: ":hola_chao" => "hola_chao;
            //largo de la clave, menos los :
            $largo = strlen($clave) -1;
            //convertir a negativo para seleccionar de atras para adelante
            $largo = -1 * abs($largo);
            $sqlB .= substr("$clave", $largo);
            $sqlD .= "$clave";
            if (self::endKey($datos) != $clave){
                $sqlB .= ", ";
                $sqlD .= ", ";
            }
        }
        //para vaciar la variable value
        unset($valor); 

        $sql = $sqlA.$sqlB.$sqlC.$sqlD.$sqlF;
        $query = $database->prepare($sql);
        $query->execute($datos);

        if ($query->rowCount() == 1) {
            //return $database->lastInsertId(); 
            return true;
        }

        //Session::add('feedback_negative', Text::get('FEEDBACK_NOTE_CREATION_FAILED'));
        return false;
    }

    public static function updateInterconsulta($datos)
    {
        if (!$datos) {
            Session::add('feedback_negative', Text::get('FEEDBACK_NOTE_CREATION_FAILED'));
            return false;
        }

        $database = DatabaseFactory::getFactory()->getConnection();

        $sqlA = "UPDATE solicitudes SET ";
        $sqlB = "";
        $sqlC = " WHERE solicitud_id = :solicitud_id LIMIT 1";

        foreach($datos as $clave => $valor) {
            //necesito remover los : de la cadena clave ej: ":hola_chao" => "hola_chao;
            //largo de la clave, menos los :
            $largo = strlen($clave) -1;
            //convertir a negativo para seleccionar de atras para adelante
            $largo = -1 * abs($largo);
            $sqlB .= substr("$clave", $largo) . " = $clave";
            if (self::endKey($datos) != $clave){
                $sqlB .= ", ";
            }
        }
        //para vaciar la variable value
        unset($valor); 

        $sql = $sqlA.$sqlB.$sqlC;
        $query = $database->prepare($sql);
        $query->execute($datos);

        if ($query->rowCount() == 1) {
            //return $database->lastInsertId(); 
            return true;
        }

        //Session::add('feedback_negative', Text::get('FEEDBACK_NOTE_CREATION_FAILED'));
        return false;
    }

    //ayuda para comprobar que llego al ultimo elemento del arreglo
    public static function endKey($array){
        end($array);
        return key($array);
    }
}
