<?php

class RespuestaModel
{
    public static function getAllNotes()
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "SELECT user_id, note_id, note_text FROM notes WHERE user_id = :user_id";
        $query = $database->prepare($sql);
        $query->execute(array(':user_id' => Session::get('user_id')));

        return $query->fetchAll();
    }

    public static function countRespuesta($solicitud_id)
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "SELECT * FROM respuestas WHERE solicitud_id = :solicitud_id LIMIT 1";
        $query = $database->prepare($sql);
        $query->execute(array(':solicitud_id' => $solicitud_id));

        if ($query->rowCount() == 1) {
            return true;
        }

        return false;
    }

    public static function getRespuesta($solicitud_id)
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "SELECT * FROM respuestas WHERE solicitud_id = :solicitud_id LIMIT 1";
        $query = $database->prepare($sql);
        $query->execute(array(':solicitud_id' => $solicitud_id));

        return $query->fetch();
    }

    public static function createRespuesta($solicitud_id, $fecha, $eg, $pfe, $pfe_percentil, $liquido, $presentacion, $dorso, $uterinas, $uterinas_percentil, $umbilical, $umbilical_percentil, $cm, $cm_percentil, $cmau, $cmau_percentil, $hipotesis, $comentariosexamen, $ecografista, $doppler, $anatomia_fetal, $tipo, $utero_primertrimestre, $saco_gestacional, $embrion, $lcn, $anexo_izquierdo_primertrimestre, $anexo_derecho_primertrimestre, $douglas_primertrimestre, $lcn_eg, $placenta,$placenta_insercion, $liquido_amniotico, $dbp, $cc, $ca, $lf, $pfe_segundo, $ccca, $presentacion_segundo, $dorso_segundo, $anatomia_segundo, $pfe_pct_segundo, $ccca_pct, $hipotesis_segundo, $utero_ginecologica, $endometrio, $anexo_izquierdo_ginecologica, $anexo_derecho_ginecologica, $ovario_izquierdo, $ovario_derecho, $douglas_ginecologica, $crecimiento_ccca, $doppler_fetal, $cc_pct,$ca_pct,$lf_pct,$respuesta_anatomia_extra, $respuesta_uterina_derecha, $respuesta_uterina_derecha_percentil, $respuesta_uterina_izquierda, $respuesta_uterina_izquierda_percentil, $respuesta_fcf, $translucencia_nucal, $respuesta_dof, $respuesta_ic, $respuesta_bvm, $respuesta_lh, $respuesta_lh_pct, $respuesta_cerebelo, $respuesta_cerebelo_pct, $respuesta_sexo)
    {
        if (!$solicitud_id) {
            Session::add('feedback_negative', Text::get('FEEDBACK_NOTE_CREATION_FAILED'));
            return false;
        }

        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "INSERT INTO respuestas (solicitud_id, fecha, eg, pfe, pfe_percentil, liquido, presentacion, dorso, uterinas, uterinas_percentil, umbilical, umbilical_percentil, cm, cm_percentil, cmau, cmau_percentil, hipotesis, comentariosexamen, ecografista, doppler, anatomia_fetal, tipo, utero_primertrimestre, saco_gestacional, embrion, lcn, anexo_izquierdo_primertrimestre, anexo_derecho_primertrimestre, douglas_primertrimestre, lcn_eg, placenta, placenta_insercion, liquido_amniotico, dbp, cc, ca, lf, pfe_segundo, ccca, presentacion_segundo, dorso_segundo, anatomia_segundo, pfe_pct_segundo, ccca_pct, hipotesis_segundo, utero_ginecologica, endometrio, anexo_izquierdo_ginecologica, anexo_derecho_ginecologica, ovario_izquierdo, ovario_derecho, douglas_ginecologica, crecimiento_ccca, doppler_fetal, cc_pct, ca_pct, lf_pct, anatomia_extra, uterina_derecha, uterina_derecha_percentil, uterina_izquierda, uterina_izquierda_percentil,respuesta_fcf, translucencia_nucal, respuesta_dof, respuesta_ic, respuesta_bvm, respuesta_lh, respuesta_lh_pct, respuesta_cerebelo, respuesta_cerebelo_pct, sexo_fetal) VALUES (:solicitud_id, :fecha, :eg, :pfe, :pfe_percentil, :liquido, :presentacion, :dorso, :uterinas, :uterinas_percentil, :umbilical, :umbilical_percentil, :cm, :cm_percentil, :cmau, :cmau_percentil, :hipotesis, :comentariosexamen, :ecografista, :doppler, :anatomia_fetal, :tipo, :utero_primertrimestre, :saco_gestacional, :embrion, :lcn, :anexo_izquierdo_primertrimestre, :anexo_derecho_primertrimestre, :douglas_primertrimestre, :lcn_eg, :placenta, :placenta_insercion,:liquido_amniotico, :dbp, :cc, :ca, :lf, :pfe_segundo, :ccca, :presentacion_segundo, :dorso_segundo, :anatomia_segundo, :pfe_pct_segundo, :ccca_pct, :hipotesis_segundo, :utero_ginecologica, :endometrio, :anexo_izquierdo_ginecologica, :anexo_derecho_ginecologica, :ovario_izquierdo, :ovario_derecho, :douglas_ginecologica, :crecimiento_ccca, :doppler_fetal, :cc_pct,:ca_pct,:lf_pct, :anatomia_extra, :uterina_derecha, :uterina_derecha_percentil, :uterina_izquierda, :uterina_izquierda_percentil, :respuesta_fcf, :translucencia_nucal, :respuesta_dof, :respuesta_ic, :respuesta_bvm, :respuesta_lh, :respuesta_lh_pct, :respuesta_cerebelo, :respuesta_cerebelo_pct, :sexo_fetal)";
        $query = $database->prepare($sql);
        $query->execute(array(':solicitud_id' => $solicitud_id, ':fecha' => $fecha, ':eg' => $eg, ':pfe' => $pfe, ':pfe_percentil' => $pfe_percentil, ':liquido' => $liquido, ':presentacion' => $presentacion, ':dorso' => $dorso, ':uterinas' => $uterinas, ':uterinas_percentil' => $uterinas_percentil, ':umbilical' => $umbilical, ':umbilical_percentil' => $umbilical_percentil, ':cm' => $cm, ':cm_percentil' => $cm_percentil, ':cmau' => $cmau, ':cmau_percentil' => $cmau_percentil, ':hipotesis' => $hipotesis, ':comentariosexamen' => $comentariosexamen, ':ecografista' => $ecografista, ':doppler' => $doppler, ':anatomia_fetal' => $anatomia_fetal, ':tipo' => $tipo, ':utero_primertrimestre' => $utero_primertrimestre, ':saco_gestacional' => $saco_gestacional, ':embrion' => $embrion, ':lcn' => $lcn, ':anexo_izquierdo_primertrimestre' => $anexo_izquierdo_primertrimestre, ':anexo_derecho_primertrimestre' => $anexo_derecho_primertrimestre, ':douglas_primertrimestre' => $douglas_primertrimestre, ':lcn_eg' => $lcn_eg, ':placenta' => $placenta, ':placenta_insercion' => $placenta_insercion, ':liquido_amniotico' => $liquido_amniotico, ':dbp' => $dbp, ':cc' => $cc, ':ca' => $ca, ':lf' => $lf, ':pfe_segundo' => $pfe_segundo, ':ccca' => $ccca, ':presentacion_segundo' => $presentacion_segundo, ':dorso_segundo' => $dorso_segundo, ':anatomia_segundo' => $anatomia_segundo, ':pfe_pct_segundo' => $pfe_pct_segundo, ':ccca_pct' => $ccca_pct, ':hipotesis_segundo' => $hipotesis_segundo, ':utero_ginecologica' => $utero_ginecologica, ':endometrio' => $endometrio, ':anexo_izquierdo_ginecologica' => $anexo_izquierdo_ginecologica, ':anexo_derecho_ginecologica' => $anexo_derecho_ginecologica, ':ovario_izquierdo' => $ovario_izquierdo, ':ovario_derecho' => $ovario_derecho, ':douglas_ginecologica' => $douglas_ginecologica, ':crecimiento_ccca' => $crecimiento_ccca, ':doppler_fetal' => $doppler_fetal, ':cc_pct' => $cc_pct, ':ca_pct' => $ca_pct, ':lf_pct' => $lf_pct, ':anatomia_extra' => $respuesta_anatomia_extra, ':uterina_derecha' => $respuesta_uterina_derecha, ':uterina_derecha_percentil' => $respuesta_uterina_derecha_percentil, ':uterina_izquierda' => $respuesta_uterina_izquierda, ':uterina_izquierda_percentil' => $respuesta_uterina_izquierda_percentil, ':respuesta_fcf' => $respuesta_fcf, ':translucencia_nucal' => $translucencia_nucal,':respuesta_dof' => $respuesta_dof, ':respuesta_ic' => $respuesta_ic, ':respuesta_bvm' => $respuesta_bvm, ':respuesta_lh' => $respuesta_lh, ':respuesta_lh_pct' => $respuesta_lh_pct, ':respuesta_cerebelo' => $respuesta_cerebelo, ':respuesta_cerebelo_pct' => $respuesta_cerebelo_pct, ':sexo_fetal' => $respuesta_sexo));

        if ($query->rowCount() == 1) {
            return true;
        }

        Session::add('feedback_negative', Text::get('FEEDBACK_NOTE_CREATION_FAILED'));
        return false;
    }

    public static function updateNote($note_id, $note_text)
    {
        if (!$note_id || !$note_text) {
            return false;
        }

        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "UPDATE notes SET note_text = :note_text WHERE note_id = :note_id AND user_id = :user_id LIMIT 1";
        $query = $database->prepare($sql);
        $query->execute(array(':note_id' => $note_id, ':note_text' => $note_text, ':user_id' => Session::get('user_id')));

        if ($query->rowCount() == 1) {
            return true;
        }

        Session::add('feedback_negative', Text::get('FEEDBACK_NOTE_EDITING_FAILED'));
        return false;
    }

    public static function deleteRespuesta($solicitud_id)
    {
        if (!$solicitud_id) {
            return false;
        }

        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "DELETE FROM solicitudes WHERE solicitud_id = :solicitud_id LIMIT 1";
        $query = $database->prepare($sql);
        $query->execute(array(':solicitud_id' => $solicitud_id));

        if ($query->rowCount() == 1) {
            return true;
        }

        Session::add('feedback_negative', Text::get('FEEDBACK_NOTE_DELETION_FAILED'));
        return false;
    }
}
