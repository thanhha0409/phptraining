<div style='width:960px'>
<?php echo $this->Session->flash('auth'); ?>
<?php echo $this->Form->create('User');?> 
    <fieldset>
    <legend>Register</legend>
    <label>Fill out the form below to register new account. If you already have an account,
         <?php echo $this->Html->link('Click here',
             array('controller'=>'users','action'=>'login')); ?>
         to Login</label>
    </fieldset>
<?php  
   echo $this->Form->input('username');
   echo $this->Form->input('password');
   echo $this->Form->input('re-password', array('label' => 'Re-password',
        'type' => 'password'));
   echo $this->Form->end(__('Register')); 
?>
</div>

