<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<?php
session_start();
if( isset($_SESSION['S_USER']) == NULL)
{
	header("location:index.php");
}
else {
	$loginUser = $_SESSION['S_USER'];

	// DB configuration
	$dbhost = "localhost";
	$dbname = "chatdb";
	$dbuser = "root";
	$dbpass = "hatrung";
	$dns = "mysql:host=" . $dbhost . ";dbname=" . $dbname;

	// Connect to database
	$conn = new PDO($dns,$dbuser,$dbpass);
}
?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>

<meta http-equiv="content-type" content="text/html; charset=utf-8" />

<meta name="description" content="" />

<meta name="keywords" content="" />

<meta name="author" content="" />

<link rel="stylesheet" type="text/css" href="style.css" media="screen" />

<title> Altplus Chat Page</title>

</head>

<body>

<div id="wrapper">

<?php include('includes/header.php'); ?>

<div id="content">
<?php 
// When click Send button
if(isset($_POST['send']))
{
	// Check does user already input
	$chatInput = $_POST['chatInput'];
	if($chatInput==NULL){
		echo "Please input content to chat.";
	}
	else{
		// In case of new chat
		if($_SESSION['S_EDIT']=="")
		{ 
		// Insert to DB
			$result=$conn->prepare("INSERT INTO message_tbl(message,username) VALUES (:message,:userSrc)");
			$result->bindParam(':message',$chatInput);
			$result->bindParam(':userSrc',$loginUser);
			$result->execute();
		}
		// In case of edit message
		else{
			$result=$conn->prepare("UPDATE message_tbl SET message =:message WHERE id =:id");
			$result->bindParam(':message',$chatInput); 
			$result->bindParam(':id',$_SESSION['S_EDIT']);
			$result->execute();
			$_SESSION['S_EDIT'] ="";
		}
	}
}

// When click Delete button
else if(isset($_POST['delete']))
{
	// Delete from DB
	$result=$conn->prepare("DELETE FROM message_tbl WHERE id = :id");
	$result->bindParam(':id',$_POST['delete']);
	$result->execute();	
}

// When click Edit button
else if(isset($_POST['edit']))
{
	// Get message from db
	$result=$conn->prepare("SELECT * FROM message_tbl WHERE id = :id");
	$result->bindParam(':id',$_POST['edit']);
	$result->execute();
	$rs = $result->fetch(PDO::FETCH_OBJ);
	$editMessage = $rs->message;
	
	// Set edit id to session
	$_SESSION['S_EDIT'] = $_POST['edit'];
}

// Get from DB
$result=$conn->prepare("SELECT * FROM message_tbl ORDER BY chat_time");
$result->execute();
		
$messageList = array();
$idList = array();
// Fill user as value of select
while ($rs = $result->fetch(PDO::FETCH_OBJ)) {
	$id=$rs->id;
	$message=$rs->message;
	$userSrc=$rs->username;
	$time=$rs->chat_time;

	// Define a line with match with a message			
	$aLine= "<label style='align:right;width:150px;height:17px'>".$userSrc."(".$time."):"."</label>". 
	"<input type=submit name=edit value='".$id."' class='edit' > </input>".
	"<input type=submit name=delete value='".$id."' class='delete'></input>".
	"<label style='max-width:850px'>".$message."</label>";
			
	// Add a line to array
	array_push($messageList,$aLine);
} 
?>

<h5 align = right style ="margin-right:30px"> <?php echo 'Hello: '. $loginUser ?> </h5>
<!-- Chat content  -->
<center><form action =chat.php method=post>
<table><tr><td colspan ='2'>
	<!-- Message list -->
	<div style="width:900px;height:350px;line-height:3em;overflow:scroll;padding:5px;background-color:#FCFADD;color:#714D03;border:1px double #DEBB07;">
		<?php
			foreach($messageList as $key=>$value) {
    				echo $value;
				echo "<br/>";
			}	
		?>
	</div>
</td></tr>
<tr><td> 
	<input type ="text" style = "width: 850px;" name="chatInput" id ="chatInput" value ="<?php echo (!empty($_POST))?$editMessage:''; ?>">
</td>
<td> 
	<input type="submit" name ="send" value = "Send"> 
</td></tr></table></form></center>
</div> <!-- end #content -->

<!-- Start #footer -->
<?php include('includes/footer.php'); ?>
<!-- End # footer -->

</div> <!-- End #wrapper -->

</body>

</html>



