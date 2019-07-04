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
    public function index()
    {
        if (Session::get("user_account_type") == 7){
            $this->View->render('admin/index', array(
                'instituciones' => InstitucionModel::getAllInstituciones(),
                'usuarios' => UserModel::getPublicProfilesOfAllUsers()
            ));
        }
        else{
            $this->View->render('index/index');
        }
        
    }
}
