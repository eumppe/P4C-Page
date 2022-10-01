<?php 
	$pw=getenv('MySQLrootPW');
	$conn=mysqli_connect('localhost','root', $pw,'eumppedb');

	$userid=$_POST['userid'];
	$password=$_POST['password'];

	try{
		$sql="SELECT * FROM users WHERE "
		."userid='".$userid."'AND "
		."password='".$password."'";
		$result=mysqli_query($conn,$sql);
		if($result!=null){
			$list=mysqli_fetch_array($result);
			session_start();
			$_SESSION['userid']=$list;
		}
	}catch(Exception $e){

	}
	header("Location: /index.php")
?>