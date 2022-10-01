<?php 
	$pw=getenv('MySQLrootPW');
	$conn=mysqli_connect('localhost','root', $pw,'eumppedb');

	$userid=$_POST['userid'];
	$password=$_POST['password'];
	$email=$_POST['email'];

	try{
		$sql="INSERT INTO users(userid, password, email) VALUES('"
		.$userid."', '"
		.$password."', '"
		.$email."')";
		mysqli_query($conn,$sql);
		header("Location: /index.php");
	}catch(Exception $e){
		header("Location: /pages/signup.php");
	}
?>