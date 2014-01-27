<div style='width:960px'>
<?php
    echo $this->Session->flash('auth');
    echo $this->Form->create('Thread');
?>
<fieldset>
<legend><?php echo "Add thread"?> </legend>
<label><?php echo "Hello: ".$loginUser." (".
         $this->Html->link('Logout',array('controller'=>'users','action'=>'logout')).")"; ?>
</label>
<label>
<?php
    echo __('Please fill out below form to add thread ');
?>
</label>
</fieldset>
<?php
    echo $this->Form->input('thread');
   // echo $this->Form->input('user',array('type'=>'hidden','value'=>$this->Auth->user('id')));
    echo $this->Form->input('created',array('type'=>'hidden','value'=>date('Y-m-d H:i:s')));
    echo $this->Form->end('Add');
 ?>
</div>

