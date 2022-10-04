<?php
	$pw=getenv('MySQLrootPW');
	$conn=mysqli_connect('127.0.0.1','root', $pw,'eumppedb');

	$email=$_POST["email"];
	$secret=0;
	do{
		$secret=rand(0,999999999);
		$sql="SELECT email FROM emailverify WHERE randnum=".$secret;
		$result=mysqli_query($conn,$sql);//TODO: 시간 지난 email들 table에서 지워줘야 함.
		$row = mysqli_fetch_array($result);
	}while($row["email"]!=null);

	$sql="INSERT INTO emailverify(email, randnum, verified) VALUES('"
		.$email."', '"
		.$secret."', "
		."FALSE".")";

	mysqli_query($conn,$sql);

	$site_address='localhost:8000';
	$message = '
<html>
<head>
  <title>Verify your email address!</title>
</head>
<body>
  <p>This mail is from the Eumppe webpage</p>
  <p>Click the button below to verify your email</p>
  <p>The link is valid only for an hour</p>
  <form action="'.$site_address.'/verify-email-link.php" method="post">
  	<input type="hidden" name="secret" value="'.$secret.'">
  	<input type="hidden" name="email" value="'.$email.'">
  	<input type="submit">
  </form>
</body>
</html>
';
	mail($email,"verify your email address",$message,"From:eumppe05@gmail.com");

	header("Location: /pages/signup.php");
?>