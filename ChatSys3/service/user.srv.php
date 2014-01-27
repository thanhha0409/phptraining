<?php
import::box('user');

class UserService extends Service
{
    /*
     * Register new user
     */
    public function registUser($user)
    {
        $user['password'] = $this->AuthSrv->hashedPass($user['password']);
        $this->UserMdl->insert($user);
    }
    
    /*
     * Get user
     */ 
    public function getUser($user){
       $user['password']= $this->AuthSrv->hashedPass($user['password']);
        $condition=array(
            'where' =>array('username'=>$user['username'], 'password'=>$user['password'])
       );
       return $this->UserMdl->find($condition);
    }
}


