<div style='width:960px'>
<?php 
    echo $this->Session->flash('auth');
    echo $this->Form->create('User'); 
?>
<fieldset>
<legend><?php echo "Login"?> </legend>
<label>
<?php
    echo __('Please enter your username/password to login or ').
         $this->Form->Html->link('Click here',
         array('controller'=>'users','action'=>'regist')). " to register"; 
?>
</label>
</fieldset>
<?php
    echo $this->Form->input('username');
    echo $this->Form->input('password');
    echo $this->Form->end('Login'); 
 ?>
</div>
