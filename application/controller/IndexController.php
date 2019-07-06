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
            $institucion = InstitucionModel::getInstitucionUser(Session::get("user_id"));
            
            if (is_object($institucion)){
                $this->View->render('index/index_four', array(
                    'institucion' => InstitucionModel::getInstitucion($institucion->institucion_id),
                    'usuarios_institucionales' => InstitucionModel::getAllUsuariosIstitucionales($institucion->institucion_id)
                ));
            }
            else{
                $this->View->render('index/index_four', array(
                    'institucion' => null
                ));
            }
        }
        else if (Session::get("user_account_type") == 3){
            $this->View->render('index/index_three');
        }
        else if (Session::get("user_account_type") == 2){
            $this->View->render('index/index_two');
        }
        else if (Session::get("user_account_type") == 1){
            $this->View->render('index/index');
        }
    }

    public function usuarios(){
        $institucion = InstitucionModel::getInstitucionUser(Session::get("user_id"));
                    
        $this->View->render('index/usuarios/add', array(
            'institucion' => InstitucionModel::getInstitucion($institucion->institucion_id),
            'usuarios' => UserModel::getPublicProfilesOfAllUsers()
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
}
