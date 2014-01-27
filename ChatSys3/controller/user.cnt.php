<?php
class UserController extends AppController{
public $allows = array('login', 'register');

    /*
     * Register a new account
     */
    public function regist(){
        $inputData = $this->request->post();
        if($inputData){
            $this->UserSrv->registUser($inputData['data']);
            $this->redirect('/user/login');
        }
    }

    /*
     * Login to system
     */
    public function login(){
        $inputData = $this->request->post();
        if($inputData){
            $user = $this->UserSrv->getUser($inputData['data'])->data();
           
            if($user){
                $this->AuthSrv->login($user['id']);
                Session::set('login_user',$user['username']);
                $this->redirect('/thread/index');
            } 
            else{
                $this->set('error', 
                    array('error'=>'Username or password is invalid. Please try again!'));
            }
        }
    }

    /*
     * Logout, redirect to login pages
     */
    public function logout(){
        $this->AuthSrv->logout();
        Session::destroy('login_user');
        Session::destroy('threadid');
        $this->redirect('/user/login');
    }
}
?>
