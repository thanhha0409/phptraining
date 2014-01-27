<?php
import::box('thread');

class ThreadService extends Service
{
    /*
     * Register new user
     */
    public function addThread($thread)
    {
        $this->ThreadMdl->insert($thread);
    }
    
    /*
     * Get all threads form db
     */ 
    public function getThreads(){
     $sql="SELECT threads.id, threads.thread, threads.created, users.id as userid, users.username as username
                FROM threads
                LEFT JOIN users
                ON threads.user=users.id";
        return $this->ThreadMdl->query($sql);
    }
    
    /*
     * Delete thread with id = $id
     */ 
    public function delThread($id){
        $sql = "delete from threads where id=".$id;
        $this->ThreadMdl->query($sql);
    }
}


