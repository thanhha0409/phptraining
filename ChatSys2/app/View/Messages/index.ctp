<fieldset>
<legend><?php echo "Thread:".$threadId?> </legend>
<label><?php echo "Hello: ".$loginUser." (".
         $this->Html->link('Logout',array('controller'=>'users','action'=>'logout')).")"; ?>
</label>
<br/>
<div style="width:900px;height:350px;line-height:2em;overflow:scroll;padding:5px;background-color:#FCFADD;color:#714D03;border:1px double #DEBB07;">
<?php
foreach ($messages as $message){

    // Display name and chat time
    echo $message['usersJoin']['username']." ( ".$message['Message']['created'].")";
    if($message['Message']['deleteFlg']==0)
    {
        if($message['usersJoin']['id']== $loginId ){
            // Add link Edit 
            echo " (". $this->Html->link('Edit',
            array('action' => 'edit',$message['Message']['id'],$threadId))."|";
      
            // Add link Delete
            echo $this->Html->link('Delete',
                array('action' => 'deleteFlg', $message['Message']['id'],$threadId)).")";
        }
   
        // Display message
        echo ": ".$message['Message']['message'];
        if($message['Message']['updated']!="0000-00-00 00:00:00"){
            echo " (edit at ".$message['Message']['updated'].")";
        }
    }else{
        echo ": This message has been removed at ".$message['Message']['updated']; 
    }

    // End line
    echo "<br/>";
}
?>
</div>
<br/>
<?php
    // Add link Add new
    echo $this->Html->link('Add',
         array('action' => 'add',$threadId))."<br/>";    
   
   // Add link Return
    echo $this->Html->link('Return to list of threads',
         array('controller'=>'threads','action' => 'index'));


?>

