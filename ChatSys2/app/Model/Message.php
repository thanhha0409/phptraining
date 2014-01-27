<?php
class Message extends AppModel{

   /* Check validate:
    * 1. Require to input message
    */
    public $validate = array(
        // Require to input message
        'message' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Message is required'
            )
        )
    );
}
?>
