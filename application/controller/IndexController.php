<?php

class IndexController extends Controller
{
    /**
     * Construct this object by extending the basic Controller class
     */
    public function __construct()
    {
        parent::__construct();
        Auth::checkAuthentication();
    }

    /**
     * Handles what happens when user moves to URL/index/index - or - as this is the default controller, also
     * when user moves to /index or enter your application at base level
     */
    public function index(){
        if (Session::get("user_account_type") == 7){
            $this->View->render('admin/index', array(
                'instituciones' => InstitucionModel::getAllInstituciones(),
                'usuarios' => UserModel::getPublicProfilesOfAllUsers()
            ));
        }
        else if (Session::get("user_account_type") == 4){
            //obtener de que institucion
            $institucion = InstitucionModel::getInstitucionJefe(Session::get("user_id"));
            
            if (is_object($institucion)){
                $this->View->render('index/index_four', array(
                    'institucion' => InstitucionModel::getInstitucion($institucion->institucion_id),
                    'usuarios_institucionales' => InstitucionModel::getAllUsuariosIstitucionalesWhereInstitucion($institucion->institucion_id)
                ));
            }
            else{
                $this->View->render('index/index_four', array(
                    'institucion' => null
                ));
            }
        }
        else if (Session::get("user_account_type") == 3){
            $instituciones = InstitucionModel::getAllInstitucionesUser(Session::get("user_id"));

            if (is_array($instituciones)){
                $this->View->render('index/index_three', array(
                    'instituciones' => $instituciones
                ));
            }
            else{
                $this->View->render('index/index_three', array(
                    'instituciones' => null
                ));
            }
        }
        else if (Session::get("user_account_type") == 2){
            $instituciones = InstitucionModel::getAllInstitucionesUser(Session::get("user_id"));

            if (is_array($instituciones)){
                $this->View->render('index/index_two', array(
                    'instituciones' => $instituciones,
                    'solicitar_instituciones' => InstitucionModel::getAllInstituciones(),
                    'interconsultas' => InterconsultasModel::getAllInterconsultas()
                ));
            }
            else{
                $this->View->render('index/index_two', array(
                    'instituciones' => null
                ));
            }
        }
        else if (Session::get("user_account_type") == 1){
            $this->View->render('index/index');
        }
    }

    public function usuarios(){
        $institucion = InstitucionModel::getInstitucionJefe(Session::get("user_id"));
                    
        $this->View->render('index/usuarios/add', array(
            'institucion' => InstitucionModel::getInstitucion($institucion->institucion_id),
            'usuarios' => UserModel::getAllUsersForInstitucion($institucion->institucion_id)
        ));
    }

    public function usuarios_add(){
        InstitucionModel::addUser(Request::post("institucion_id"), Request::post("user_id"));
        Redirect::Home();
    }

    public function usuarios_remove(){
        InstitucionModel::removeUser(Request::post("institucion_id"), Request::post("user_id"));
        Redirect::Home();
    }

    public function solicitar_interconsulta(){
        $datos = array(":user_id" => Session::get("user_id"), ":institucion_id" => Request::post("a"), ":solicitud_nombre" => Request::post("b"), ":solicitud_rut" => Request::post("c"), ":solicitud_telefono" => Request::post("d"), ":solicitud_fecha" => Request::post("e"), ":solicitud_eg_conocida" => Request::post("f"), ":solicitud_eco_previa" => Request::post("g"), ":solicitud_fum" => Request::post("h"), ":solicitud_egestacional" => Request::post("i"), ":solicitud_diagnostico" => Request::post("j"), ":solicitud_ciudad" => Request::post("k"), ":solicitud_lugar" => Request::post("l"));
        $respuesta = new stdClass();
        $respuesta->result = InterconsultasModel::createInterconsulta($datos);
        $this->View->renderJSON($respuesta);
    }
}
