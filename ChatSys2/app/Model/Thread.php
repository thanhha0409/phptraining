<?php
class Thread extends AppModel{

    /* 
     * Require to input thread
     */
    public $validate = array(
        // Require to input thread
        'thread' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Thread name is required'
            )
        )
    );
}
?>
