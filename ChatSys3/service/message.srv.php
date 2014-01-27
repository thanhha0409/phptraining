<?php
class MessageService extends Service
{ 
    /*
     * Save new message to db
     */
    public function addMessage($msg){
        $this->MessageMdl->insert($msg);
    }

    /*
     * Get all messages of a thread
    */
    public function getMessages($threadid){
        $sql="SELECT messages.id, messages.message, messages.created, messages.modified, messages.deleteFlg,
                    users.id as userid, users.username as username,
                    threads.id as threadid, threads.thread as threadname
                FROM messages
                LEFT JOIN users
                ON messages.user=users.id
                LEFT JOIN threads
                ON messages.thread=threads.id
                WHERE messages.thread=".$threadid."
                ORDER BY messages.created";
        return $this->MessageMdl->query($sql);
    }

    /*
     * Get message has id = $id
    */
    public function getMessage($id){
        return $this->MessageMdl->read($id);
    }

    /*
     * Edit a message
     */
    public function editMessage($editData){
        $message = $this->MessageMdl->read($editData['id']);
        $message->setData($editData);
        $message->save();

    }

    /*
     * Delete message
     */
    public function delMessage($id){
        $sql = "update messages set deleteFlg =1 where id=".$id;
        $this->MessageMdl->query($sql);
    }
}
