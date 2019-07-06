<?php

class AdminController extends Controller
{
    /**
     * Construct this object by extending the basic Controller class
     */
    public function __construct()
    {
        parent::__construct();
        // special authentication check for the entire controller: Note the check-ADMIN-authentication!
        // All methods inside this controller are only accessible for admins (= users that have role type 7)
        Auth::checkAdminAuthentication();
    }

    /**
     * This method controls what happens when you move to /admin or /admin/index in your app.
     */
    public function index()
    {
        $this->View->render('admin/index', array(
                'users' => UserModel::getPublicProfilesOfAllUsers())
        );
    }

    public function instituciones($accion = null, $institucion_id = null)
    {
        switch ($accion){
            case "new":
                $this->View->render('admin/instituciones/new', array(
                    'usuarios' => UserModel::getPublicProfilesOfAllUsers()
                ));
                break;
            case "create":
                InstitucionModel::createInstitucion(Request::post("institucion_text"), Request::post("user_id"));
                Redirect::home();
                break;
            case "view":
                $this->View->render('admin/instituciones/view', array(
                    'institucion' => InstitucionModel::getInstitucion($institucion_id),
                    'usuarios_institucionales' => InstitucionModel::getAllUsuariosIstitucionales($institucion_id)
                ));
                break;
            case "add":
                $this->View->render('admin/instituciones/add', array(
                    'institucion' => InstitucionModel::getInstitucion($institucion_id),
                    'usuarios' => UserModel::getPublicProfilesOfAllUsers()
                ));
                break;
            case "join":
                InstitucionModel::addUser(Request::post("institucion_id"), Request::post("user_id"));
                Redirect::to("admin/instituciones/view/".Request::post("institucion_id"));
                break;
            case "remove":
                InstitucionModel::removeUser(Request::post("institucion_id"), Request::post("user_id"));
                Redirect::to("admin/instituciones/view/".Request::post("institucion_id"));
                break;
            default:
                Redirect::home();
        }
    }

    public function usuarios($accion = null, $user_id = null)
    {
        switch ($accion){
            case "delete":
                UserModel::removeUser($user_id);
                Redirect::to("admin/instituciones/view/".Request::post("institucion_id"));
                break;
            default:
                Redirect::home();
        }
    }

    public function actionAccountSettings()
    {
        AdminModel::setAccountSuspensionAndDeletionStatus(
            Request::post('suspension'), Request::post('softDelete'), Request::post('user_id')
        );

        Redirect::to("admin");
    }
}
