<div style='width:960px'>
<?php
    echo $this->Session->flash('auth');
    echo $this->Form->create('Message');
?>
<fieldset>
<legend><?php echo "Add a new messages to thread ".$threadId?> </legend>
<label><?php echo "Hello: ".$loginUser." (".
         $this->Html->link('Logout',array('controller'=>'users','action'=>'logout')).")"; ?>
</label>
<label>
<?php
    echo __('Please fill out below form to add a new message ');
?>
</label>
</fieldset>
<?php
    echo $this->Form->input('message');
    echo $this->Form->input('created',array('type'=>'hidden','value'=>date('Y-m-d H:i:s')));
    echo $this->Form->end('Add');
 ?>
</div>

