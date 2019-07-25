<?php

/**
 * This controller shows an area that's only visible for logged in users (because of Auth::checkAuthentication(); in line 16)
 */
class DashboardController extends Controller
{
    /**
     * Construct this object by extending the basic Controller class
     */
    public function __construct()
    {
        parent::__construct();

        // this entire controller should only be visible/usable by logged in users, so we put authentication-check here
        Auth::checkAuthentication();
    }

    /**
     * This method controls what happens when you move to /dashboard/index in your app.
     */
    public function index()
    {
        $this->View->render('dashboard/index');
    }

    //nuevos temporales
    public function save(){
        $respuesta_crecimiento = Request::post('solicitud_crecimiento');
        $solicitud_id = Request::post('solicitud_id');
        $respuesta_fecha = Request::post('respuesta_fecha');
        $respuesta_eg = Request::post('respuesta_eg');
        $respuesta_pfe = Request::post('respuesta_pfe');
        $respuesta_pfe_pct = Request::post('respuesta_pfe_pct');
        $respuesta_liquido = Request::post('respuesta_liquido');
        $respuesta_presentacion = Request::post('respuesta_presentacion');
        $respuesta_dorso = Request::post('respuesta_dorso');
        $respuesta_uterinas = Request::post('respuesta_uterinas');
        $respuesta_uterinas_percentil = Request::post('respuesta_uterinas_percentil');
        $respuesta_umbilical = Request::post('respuesta_umbilical');
        $respuesta_umbilical_percentil = Request::post('respuesta_umbilical_percentil');
        $respuesta_cm = Request::post('respuesta_cm');
        $respuesta_cm_percentil = Request::post('respuesta_cm_percentil');
        $respuesta_cmau = Request::post('respuesta_cmau');
        $respuesta_cmau_percentil = Request::post('respuesta_cmau_percentil');
        $respuesta_hipotesis = Request::post('respuesta_hipotesis');
        $respuesta_controlfecha = Request::post('respuesta_controlfecha');
        $respuesta_comentariosexamen = Request::post('respuesta_comentariosexamen');
        $respuesta_ecografista = Request::post('respuesta_ecografista');
        $respuesta_doppler_materno = Request::post('respuesta_doppler_materno');
        $respuesta_doppler_fetal = Request::post('respuesta_doppler_fetal');
        $respuesta_anatomia = Request::post('respuesta_anatomia');
        $respuesta_anatomia_extra = Request::post('respuesta_anatomia_extra');
        $respuesta_sexo_fetal = Request::post('respuesta_sexo_fetal');

        //para ecografía de primer trimestre
        $respuesta_utero_primertrimestre = Request::post('respuesta_utero_primertrimestre');
        $respuesta_saco_gestacional = Request::post('respuesta_saco_gestacional');
        $respuesta_embrion = Request::post('respuesta_embrion');
        $respuesta_lcn = Request::post('respuesta_lcn');
        $respuesta_anexo_izquierdo_primertrimestre = Request::post('respuesta_anexo_izquierdo_primertrimestre');
        $respuesta_anexo_derecho_primertrimestre = Request::post('respuesta_anexo_derecho_primertrimestre');
        $respuesta_douglas_primertrimestre = Request::post('respuesta_douglas_primertrimestre');
        $respuesta_lcn_eg = Request::post('respuesta_lcn_eg');

        //para ecografía de segundo trimestre
        $respuesta_placenta = Request::post('respuesta_placenta');
        $respuesta_placenta_insercion = Request::post('respuesta_placenta_insercion');
        $respuesta_liquido_amniotico = Request::post('respuesta_liquido_amniotico');
        $respuesta_dbp = Request::post('respuesta_dbp');
        $respuesta_cc = Request::post('respuesta_cc');
        $respuesta_cc_pct = Request::post('respuesta_cc_pct');
        $respuesta_ca = Request::post('respuesta_ca');
        $respuesta_ca_pct = Request::post('respuesta_ca_pct');
        $respuesta_lf = Request::post('respuesta_lf');
        $respuesta_lf_pct = Request::post('respuesta_lf_pct');
        $respuesta_ccca = Request::post('respuesta_ccca');
        $respuesta_dorso_segundo = Request::post('respuesta_dorso_segundo');
        $respuesta_ccca_pct = Request::post('respuesta_ccca_pct');
        $respuesta_crecimiento_ccca = Request::post('respuesta_crecimiento_ccca');
        $respuesta_dof = Request::post('respuesta_dof');
        $respuesta_ic = Request::post('respuesta_ic');
        $respuesta_bvm = Request::post('respuesta_bvm');
        $respuesta_lh = Request::post('respuesta_lh');
        $respuesta_lh_pct = Request::post('respuesta_lh_pct');
        $respuesta_cerebelo = Request::post('respuesta_cerebelo');
        $respuesta_cerebelo_pct = Request::post('respuesta_cerebelo_pct');

        //para ginecología
        $respuesta_utero_ginecologica = Request::post('respuesta_utero_ginecologica');
        $respuesta_endometrio = Request::post('respuesta_endometrio');
        $respuesta_anexo_izquierdo_ginecologica = Request::post('respuesta_anexo_izquierdo_ginecologica');
        $respuesta_anexo_derecho_ginecologica = Request::post('respuesta_anexo_derecho_ginecologica');
        $respuesta_ovario_izquierdo = Request::post('respuesta_ovario_izquierdo');
        $respuesta_ovario_derecho = Request::post('respuesta_ovario_derecho');
        $respuesta_douglas_ginecologica = Request::post('respuesta_douglas_ginecologica');

        $respuesta_uterina_derecha = Request::post('respuesta_uterina_derecha');
        $respuesta_uterina_derecha_percentil = Request::post('respuesta_uterina_derecha_percentil');
        $respuesta_uterina_izquierda = Request::post('respuesta_uterina_izquierda');
        $respuesta_uterina_izquierda_percentil = Request::post('respuesta_uterina_izquierda_percentil');
        $respuesta_fcf = Request::post('respuesta_fcf');
        $respuesta_translucencia_nucal = Request::post('respuesta_translucencia_nucal');

        if ($respuesta_crecimiento == 0){
            RespuestaModel::createRespuesta($solicitud_id, $respuesta_fecha, $respuesta_eg, $respuesta_pfe, $respuesta_pfe_pct, $respuesta_liquido, $respuesta_presentacion, $respuesta_dorso, $respuesta_uterinas, $respuesta_uterinas_percentil, $respuesta_umbilical, $respuesta_umbilical_percentil, $respuesta_cm, $respuesta_cm_percentil, $respuesta_cmau, $respuesta_cmau_percentil, $respuesta_hipotesis, $respuesta_comentariosexamen, $respuesta_ecografista, $respuesta_doppler_materno, $respuesta_anatomia, $respuesta_crecimiento, "", "", "", "", "", "", "", "", $respuesta_placenta,$respuesta_placenta_insercion, "", "", "", "", "", "", $respuesta_ccca, "", "", "", "", $respuesta_ccca_pct, "", "", "", "", "", "", "","","", $respuesta_doppler_fetal,"","","",$respuesta_anatomia_extra, $respuesta_uterina_derecha, $respuesta_uterina_derecha_percentil, $respuesta_uterina_izquierda, $respuesta_uterina_izquierda_percentil, "", "", "", "", $respuesta_bvm, "", "", "", "",$respuesta_sexo_fetal);
        }
        else if ($respuesta_crecimiento == 1){
            RespuestaModel::createRespuesta($solicitud_id, $respuesta_fecha, $respuesta_eg, "", "", "", "", "", "", "", "", "", "", "", "", "", "", $respuesta_comentariosexamen, $respuesta_ecografista, "", "", $respuesta_crecimiento, $respuesta_utero_primertrimestre, $respuesta_saco_gestacional, $respuesta_embrion, $respuesta_lcn, $respuesta_anexo_izquierdo_primertrimestre, $respuesta_anexo_derecho_primertrimestre, $respuesta_douglas_primertrimestre, $respuesta_lcn_eg, "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "","","","","","",$respuesta_anatomia_extra, "", "", "", "", "", "", "", "", "", "", "", "", "","");
        }
        else if ($respuesta_crecimiento == 2){
            RespuestaModel::createRespuesta($solicitud_id, $respuesta_fecha, $respuesta_eg, "","", "", "", "", "", "", "", "", "", "", "", "", "", $respuesta_comentariosexamen, $respuesta_ecografista, "", "", $respuesta_crecimiento, "", "", "", "", "", "", "", "", $respuesta_placenta,$respuesta_placenta_insercion, $respuesta_liquido_amniotico, $respuesta_dbp, $respuesta_cc, $respuesta_ca, $respuesta_lf, $respuesta_pfe, $respuesta_ccca, $respuesta_presentacion, $respuesta_dorso_segundo, $respuesta_anatomia, $respuesta_pfe_pct, $respuesta_ccca_pct, $respuesta_hipotesis, "", "", "", "", "", "", "",$respuesta_crecimiento_ccca, "",$respuesta_cc_pct,$respuesta_ca_pct,$respuesta_lf_pct,$respuesta_anatomia_extra, "", "", "", "", "", "", $respuesta_dof, $respuesta_ic, $respuesta_bvm, $respuesta_lh, $respuesta_lh_pct, $respuesta_cerebelo, $respuesta_cerebelo_pct,$respuesta_sexo_fetal);
        }
        else if ($respuesta_crecimiento == 3){
            RespuestaModel::createRespuesta($solicitud_id, $respuesta_fecha, "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", $respuesta_comentariosexamen, $respuesta_ecografista, "", "", $respuesta_crecimiento, "", "", "", "", "", "", "", "", "", "", "", "", "", "", "","", "", "", "", "", "", "", "", $respuesta_utero_ginecologica, $respuesta_endometrio, $respuesta_anexo_izquierdo_ginecologica, $respuesta_anexo_derecho_ginecologica, $respuesta_ovario_izquierdo, $respuesta_ovario_derecho, $respuesta_douglas_ginecologica,"","","","","", $respuesta_anatomia_extra, "", "", "", "", "", "", "", "", "", "", "", "", "","");
        }
        else if($respuesta_crecimiento == 4){
            RespuestaModel::createRespuesta($solicitud_id, $respuesta_fecha, $respuesta_eg, "", "", "", "", "", $respuesta_uterinas, $respuesta_uterinas_percentil, "", "", "", "", "", "", "", $respuesta_comentariosexamen, $respuesta_ecografista, "", $respuesta_anatomia, $respuesta_crecimiento, "", "", $respuesta_embrion, $respuesta_lcn, "", "", "", $respuesta_lcn_eg, "","", "", $respuesta_dbp, $respuesta_cc, $respuesta_ca, $respuesta_lf, "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", $respuesta_anatomia_extra, $respuesta_uterina_derecha, $respuesta_uterina_derecha_percentil, $respuesta_uterina_izquierda, $respuesta_uterina_izquierda_percentil, $respuesta_fcf, $respuesta_translucencia_nucal, "", "", "", "", "", "", "","");
        }

        $respuesta = new stdClass();
        $datos = array(":solicitud_id" => $solicitud_id, ":solicitud_estado" => 4);
        $respuesta->result = InterconsultasModel::updateInterconsulta($datos);
        $this->View->renderJSON($respuesta);
    }
}
