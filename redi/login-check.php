<?php 
	$pw=getenv('MySQLrootPW');
	$conn=mysqli_connect('127.0.0.1','root', $pw,'eumppedb');

	$userid=$_POST['userid'];
	$password=$_POST['password'];

	try{
		$sql="SELECT * FROM users WHERE "
		."userid='".$userid."'AND "
		."password='".$password."'";
		$result=mysqli_query($conn,$sql);
		$row=mysqli_fetch_array($result);
		if($row["userid"]!=null){
			$list=mysqli_fetch_array($result);
			session_start();
			$_SESSION['userid']=$list;
			header("Location: /index.php");
		}else{
			header("Location: /pages/login.php?msg=failed to login");
		}
	}catch(Exception $e){

	}
?>