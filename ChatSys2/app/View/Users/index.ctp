<?php 
    echo $this->Html->link('Login',
        array('controller' => 'users', 'action' => 'login'));
    echo "<br/>";
    echo $this->Html->link('Register',
        array('controller' => 'users', 'action' => 'regist'));
?>

