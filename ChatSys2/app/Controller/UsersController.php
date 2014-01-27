<?php
class UsersController extends AppController {

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('regist');
    }
    
    public function index() {
        return $this->redirect(array('action' => 'login'));
    }
    
    public function login() {
        if ($this->request->is('post')) {
	var_dump($this->data);
            if ($this->Auth->login()) {
                return $this->redirect(array('controller'=>'threads','action'=>'index'));
            }
            $this->Session->setFlash(__('Invalid username or password, try again'));
        }
    }

    public function logout() {
        return $this->redirect($this->Auth->logout());
    }   

    public function regist() {
        if ($this->request->is('post')) {
            $this->User->create();
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('The user has been saved'));
	return $this->redirect(array('action' => 'regist'));
            }
            $this->Session->setFlash(
                __('The user could not be saved. Please, try again.')
            );
        }
    }
}
?>