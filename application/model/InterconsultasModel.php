<?php

class InterconsultasModel
{

    public static function getAllInterconsultas()
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "SELECT * FROM solicitudes";
        $query = $database->prepare($sql);
        $query->execute();

        return $query->fetchAll();
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
            if (end($datos) != $valor){
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
}
