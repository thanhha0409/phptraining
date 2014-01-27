<?php
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

/**
* Model of user
*/
class User extends AppModel{
    
    /**
    * Check validate:
    * 1. Require to input username
    * 2. Require to input password
    * 3. Require to input re-password
    * 4. Require to match password and re-password
    */
    public $validate = array(
        // Require to input username
        'username' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'A username is required'
            )
        ),

        // Require to input password
        'password' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'A password is required'
            )  
        ),
 
        // Require to input re-password and check is match
        're-password' =>array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'A password is required'
            ),
            'required' => array(
              'rule' =>'isMatch',
                'message' => 'The re-passwords do not match with password')
        )    
    );

    /**
    * Check the password and re-password is match or not
    */
    function isMatch()
    {
        return !strcmp($this->data['User']['password'],$this->data['User']['re-password']);
    }

    /**
    * Hash password before save
    */
    public function beforeSave($options = array()) {
        if (isset($this->data[$this->alias]['password'])) {
            $passwordHasher = new SimplePasswordHasher();
            $this->data[$this->alias]['password'] = $passwordHasher->hash(
                $this->data[$this->alias]['password']
            );
        }

        return true;
    }
}
?>
