<?php
class ThreadsController extends AppController{
   
    public $components = array(
        'Session',
        'Auth' => array(
            'logoutRedirect' => array('controller' => 'users','action' => 'login'),
            'authorize' => array('Controller') // Added this line
        )
    );


    /*
     * Get all thread from DB
     */
    function index(){
        $this->set('threads',$this->Thread->find('all',array(
            'joins' => array(array(
                'table' => 'users',
                'alias' => 'usersJoin',
                'type' => 'left',
                'conditions' => array('usersJoin.id = Thread.user')
            )),
            'fields'=> array('Thread.id','Thread.thread','Thread.created','usersJoin.id','usersJoin.username')
        )));
    }
 
     /*
      * Add a thread to DB
      */
     public function add() {
        if ($this->request->is('post')) {
            $this->Thread->create();
            $this->request->data['Thread']['user'] = $this->Auth->user('id'); 
            if ($this->Thread->save($this->request->data)) {
                $this->Session->setFlash(__('The thread %s has been added',$this->request->data['Thread']['thread']));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(
                __('The thread could not be added. Please, try again.')
            );
        }
    }


    /*
     * Get all thread from DB
     */
    public function delete($id) {
        if ($this->Thread->delete($id)){
            $this->Session->setFlash(
                 __('The thread with id: %s has been deleted.', ($id)));
                return $this->redirect(array('action' => 'index'));
        }
    }
 
    /*
     * Check authentication
     */
    public function isAuthorized(){
        if($this->Auth->user('id')!=null){
	    $this->set('loginId',$this->Auth->user('id')); 
            $this->set('loginUser',$this->Auth->user('username')); 
            return true;            
        }else{
            return false;
	}
    }
}
?>
