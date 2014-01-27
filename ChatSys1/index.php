<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

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

<h3>Login</h3>

<form action=index.php method=post>

<table align="center">

<tr><td>Username:</td><td> <input type=text name=username size=25 /></td></tr>

<tr><td>Password:</td><td> <input type=password name=password size=25 /></td></tr>

<tr><td colspan ="2"> <input type =submit name =ok value ="Login"/> </td></tr>

</table>

</form>

<br><br>

<?php 
session_start();

if(isset($_POST['ok']))
{
	$errFlg = false;
	$errMsg = "";

	// Check has user already inputed username/password
	if(($_POST['username'] == NULL)||($_POST['password'] ==NULL))
	{
		$errFlg = true;
		$errMsg = "Please enter your username and password <br />";
	}
	else
	{	
		// Get inputed value
		$u=$_POST['username'];
		$p=$_POST['password'];
		
		// DB configuration
		$dbhost = "localhost";
		$dbname = "chatdb";
		$dbuser = "root";
		$dbpass = "hatrung";
		$dns = "mysql:host=" . $dbhost . ";dbname=" . $dbname;

		// Connect to database
		$conn = new PDO($dns,$dbuser,$dbpass);
	
		// Query to user_tbl table
		$result = $conn->prepare("SELECT * FROM user_tbl WHERE username = :user AND password = :pass");
		$result->bindParam(':user', $u);
		$result->bindParam(':pass', $p);	
		$result->execute();
		$row = $result->fetch(PDO::FETCH_NUM);
		
		// If username/pass is matching, go to chat.php page
		if($row >0)
		{
						
			// update online status
			$result = $conn->prepare("UPDATE user_tbl SET is_online = 1 WHERE username =:user");
			$result->bindParam(':user',$u);
			$result->execute();
			$_SESSION['S_USER']=$u;
			header("location:chat.php");
		}
		else
		{
			$errFlg = true;
			$errMsg = "Username or password does not match!";	
		}
	}

	// If login is not successfully.	
	if($errFlg)
	{
		echo $errMsg;
	}
}

?>

</div> <!-- end #content -->

<?php include('includes/footer.php'); ?>

</div> <!-- End #wrapper -->

</body>

</html>

