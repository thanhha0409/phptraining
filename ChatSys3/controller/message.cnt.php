<?php
class MessageController extends AppController{

    /*
     * Add a new message
     */
    public function add(){
        $inputData = $this->request->post();
        if($inputData){
            $inputData['data']['user']=$this->AuthSrv->user_id();
            $inputData['data']['thread']=Session::get('threadid');
            $this->MessageSrv->addMessage($inputData['data']);
            $this->redirect('/message/index/'.Session::get('threadid'));
        }
    }

    /*
     * Get all messages from Db
     */
    public function index($threadid){
        $messages = $this->MessageSrv->getMessages($threadid);
        $this->set('messages',$messages);
        Session::set('threadid',$threadid);
    }
  
    /*
     * Edit message
     */
    public function edit($id){
        $msg = $this->MessageSrv->getMessage($id)->data();
        Session::set("msgid",$id);
        Session::set('content',$msg['message']);
        $editedData = $this->request->post();
        if($editedData){
            $editedData['data']['id'] = $id; 
            $this->MessageSrv->editMessage($editedData['data']);
            $this->redirect('/message/index/'.Session::get('threadid'));
        }
    }

    /*
     * Delete message
     */
    public function delete($id){
        $this->MessageSrv->delMessage($id);
        $this->redirect('/message/index/'.Session::get('threadid'));
    }
}
?>
