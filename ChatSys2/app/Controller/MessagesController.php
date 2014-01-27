<?php
class MessagesController extends AppController{
   
    /*
     * Check authentication
     */
    public $components = array(
        'Session',
        'Auth' => array(
            'logoutRedirect' => array('controller' => 'users','action' => 'login'),
            'authorize' => array('Controller')
        )
    );


    /*
     * Get all thread from DB
     * @param: $threadId: Id of thread
     */
    function index($threadId=null){
        // In case of param is null, throw exception
        if(!$threadId){
            throw new NotFoundException(__('Invalid post'));
        }
        else{
            // Get all message form DB
            $this->set('messages',$this->Message->find('all',array(
                // Join to users & threads table to get name
                'joins' => array(
                    array(
                        'table' => 'users',
                        'alias' => 'usersJoin',
                        'type' => 'left',
                        'conditions' => array('usersJoin.id = Message.user')
                    ),
                    array(
                        'table' => 'threads',
                        'alias' => 'threadsJoin',
                        'type' => 'left',
                        'conditions' => array('threadsJoin.id = Message.thread')
                    ),
                ),
                'conditions'=>array('Message.thread='. $threadId,),
                'order' => 'Message.created', 
                'fields'=> array('Message.id','Message.message','Message.created','Message.updated','Message.deleteFlg',
                                 'threadsJoin.id','threadsJoin.thread','usersJoin.id','usersJoin.username')
            )));
            $this->set('threadId',$threadId);
        }
    }
 
     /*
      * Add a message to DB
      * @param: $threadId: Id of thread
      */
     public function add($threadId=null) {
        // In case of param is null, throw exception
        if (!$threadId){
            throw new NotFoundException(__('Invalid post'));
        }
        else{ 
	
            // Set threadId to variable to display on edit pages
            $this->set('threadId',$threadId);
            
            // Execute to edit
            if ($this->request->is('post')) {
                $this->Message->create();
            
                // Set thread id, user id to data
                $this->request->data['Message']['thread'] = $threadId; 
                $this->request->data['Message']['user'] = $this->Auth->user('id'); 
                
                // Save data to DB
                if ($this->Message->save($this->request->data)) {
                    $this->Session->setFlash(__('The message has been added'));
                    return $this->redirect(array('controller'=>'messages','action' => 'index',$threadId));
                }

                // In case of create fail, display error message
                $this->Session->setFlash(
                    _('The messages could not be added. Please, try again.')
                );
            }
        }
    }
    
    /*
     * Edit  a messase
     * @param: $id: id of messase
     * @param: $threadId: Id of thread
     */
    public function edit($id = null,$threadId=null) {
        // In case of param is null, throw exception
        if (!$id) {
            throw new NotFoundException(__('Invalid post'));
        }
        if (!$threadId) {
            throw new NotFoundException(__('Invalid post'));
        }

	// Set threadId to variable to display on edit pages
        $this->set('threadId',$threadId);

	// Check the edit message has exist in DB or not
        $message = $this->Message->findById($id);
        if (!$message) {
            throw new NotFoundException(__('Invalid post'));
        }

        // Execute to edit
        if ($this->request->is(array('post', 'put'))) {
            $this->Message->id = $id;
            
            // In case of edit successfully, return to index pages
            if ($this->Message->save($this->request->data)) {
                $this->Session->setFlash(__('Your messase has been edited.'));
                return $this->redirect(array('action' => 'index',$threadId));
            }

            // In case of edit fail, show messages
            $this->Session->setFlash(__('Unable to edit your message.'));
        }

        if (!$this->request->data) {
            $this->request->data = $message;
        }
    }

     /*
     * Edit  a messase
     * @param: $id: id of messase
     * @param: $threadId: Id of thread
     */
    public function deleteFlg($id = null,$threadId=null) {
        // In case of param is null, throw exception
        if (!$id) {
            throw new NotFoundException(__('Invalid post'));
        }
        if (!$threadId) {
            throw new NotFoundException(__('Invalid post'));
        }

        // Set value to edit
        $this->Message->id = $id;
        $this->request->data['Message']['deleteFlg']=1;
        $this->request->data['Message']['updated']=date('Y-m-d h:i:s');   
       
        // In case of edit successfully, return to index pages
        if ($this->Message->save($this->request->data)) {
            $this->Session->setFlash(__('Your messase has been deleted.'));
            return $this->redirect(array('action' => 'index',$threadId));
        }

        // In case of edit fail, show messages
        $this->Session->setFlash(__('Unable to delete  message.'));
    }


    /*
     * Get all thread from DB
     */
    public function delete($id,$threadId) {
        // In case of param is null, throw exception
        if (!$id) {
            throw new NotFoundException(__('Invalid post'));
        }
        if (!$threadId) {
            throw new NotFoundException(__('Invalid post'));
        }
   
        // Execute to delete
        if ($this->Message->delete($id)){
            $this->Session->setFlash(
                 __('The message with id: %s has been deleted.', ($id)));
                return $this->redirect(array('action' => 'index',$threadId));
        }
    }
 
    /*
     * Check authentication
     */
    public function isAuthorized(){
        if($this->Auth->user('id')!=null){
	    $this->set('loginId',$this->Auth->user('id')); 
            $this->set('loginUser',$this->Auth->user('username')); 
           // $this->set()
            return true;            
        }else{
            return false;
	}
    }
}
?>
