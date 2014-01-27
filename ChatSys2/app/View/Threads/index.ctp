<fieldset>
<legend><?php echo "List of threads"?> </legend>
<label><?php echo "Hello: ".$loginUser." (".
         $this->Html->link('Logout',array('controller'=>'users','action'=>'logout')).")"; ?>
</label>

<?php
foreach ($threads as $thread){
    // Display message
    echo $this->Html->link($thread['Thread']['thread'],
         array('controller'=>'messages','action'=>'index',$thread['Thread']['id']))."<br/>";


    // Display name and Thread time
    echo "Created by: ". $thread['usersJoin']['username']."<br/> at ".$thread['Thread']['created']."<br/>";

       
    if($thread['usersJoin']['id']== $loginId ){
        // Add link Delete
        echo $this->Html->link('Delete',
            array('action' => 'delete', $thread['Thread']['id']));
    }
    
    // End line 
    echo "<br/><br/>";
}

    // Add link Delete
    echo $this->Html->link('Add',
         array('controller'=>'threads','action' => 'add'));
?>
