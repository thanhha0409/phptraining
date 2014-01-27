<?php
class ThreadController extends AppController{
    
    /*
     * Add a new thread
     */
    public function add(){
        $inputData = $this->request->post();
        if($inputData){
            $inputData['data']['user']=$this->AuthSrv->user_id();
            $this->ThreadSrv->addThread($inputData['data']);
            $this->redirect('/thread/index');
        }
    }

    /*
     * Get all threads from Db
     */
    public function index(){
        $threads = $this->ThreadSrv->getThreads();
	$this->set('threads',$threads);
    }

    /*
     * Delete thread
     */
    public function delete($id){
        d("delete thread ".$id);
        $this->ThreadSrv->delThread($id);       
        $this->redirect('/thread/index');
    }
}
?>
