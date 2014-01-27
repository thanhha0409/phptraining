<?php 
class AppController extends Controller{
    // List allowed actions
    public $allows = array();

    // is controller required authentication
    public $isAuthorized = true;

    public function beforeFilter() {
        parent::beforeFilter();
        if ($this->isAuthorized && !in_array($this->request->action(), $this->allows)) {
            if (!$this->AuthSrv->user_id()) {
                $this->redirect('/user/login');
            }
        }
    }
}
?>
