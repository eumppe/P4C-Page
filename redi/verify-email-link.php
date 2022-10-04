<?php
	$pw=getenv('MySQLrootPW');
	$conn=mysqli_connect('127.0.0.1','root', $pw,'eumppedb');
	
	$sent_secret=$_POST["secret"];
	$sent_email=$_POST["email"];

	$sql="SELECT secret FROM emailverify WHERE email=".$sent_email;
	$result=mysqli_query($conn,$sql);

	if ($result==$sent_secret){
		$sql="UPDATE emailverify SET verified=TRUE WHERE email=".$sent_email;
		mysqli_query($conn,$sql);
		echo "<h1>email is verified. <br/>
		 email: ".$sent_email."</h1>
		 The verification is only valid for an hour from the time the mail was sent.<br/>
		 Make sure to finish your sign up.
		 ";
	}else{
		echo "<h1>verification failed <br/>
		 email: ".$sent_email."</h1>
		 ";
	}
?>