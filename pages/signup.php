<?php 
$pw=getenv('MySQLrootPW');
$conn=mysqli_connect('127.0.0.1','root', $pw,'eumppedb');

$verified=false;

$email_msg='';
if($_POST['request']=='verify-email'){
	$sql="DELETE FROM emailverify WHERE TIMESTAMPDIFF(HOUR, validfrom, NOW())>0";
	mysqli_query($conn, $sql);

	$email=$_POST["email"];

	$sql="SELECT verified FROM emailverify WHERE email='".$email."'";
	$result=mysqli_query($conn, $sql);
	if($row=mysqli_fetch_array($result)){
		if($row['verified']){
			$verified=true;
			$email_msg='verification complete!';
		}else{
			$email_msg='The email for verification has been sent already, but the email address is not verified yet. Please check your mailbox.';
		}
	}else{

	$secret=rand(0,999999999);

	$sql="INSERT INTO emailverify(email, randnum, verified) VALUES('"
		.$email."', '"
		.$secret."', "
		."FALSE".")";

	mysqli_query($conn,$sql);

	$site_address=$pw=getenv('siteAddress');;
	$message = '
	<!DOCTYPE html>
	<html>
	<head>
	  <title>Verify your email address!</title>
	</head>
	<body>
	  <p>This mail is from the Eumppe webpage</p>
	  <p>Click the button below to verify your email</p>
	  <p>The link is valid only for an hour</p>
	  <a href="'.$site_address.'/redi/verify-email-link.php?secret='.$secret.'&email='.$email.'">Click here!</a>
	</body>
	</html>
	';
		mail($email,"Verify your email address",$message,"From:eumppe05@gmail.com; \r\nContent-type: text/html;\r\n charset: utf8");

		$email_msg='The email for verification is sent. Please check your mailbox.';
	}
}

?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Signup-Eumppe</title>
	<link rel="stylesheet" type="text/css" href="/css/main.css">
</head>
<body>
	<header>
		<section class="signup-header">
			<a href="/index.php">
					<img class=" home-header-icon"src="/img/Eumppe.png"/>
				</a>
		</section>
	</header>
	<main>
		<fieldset>
			<legend>Signup</legend>
			<fieldset <?php if($verified){echo ('disabled');}?>>
				<form class="verify-email" action="/pages/signup.php" method="post">
					<input type="hidden" name="request" value="verify-email">
					<input type="email" name="email" placeholder="email" value="<?php echo($email)?>" required>
					<input type="submit" name="verify-email" value="verify">
					<?php echo("<p>".$email_msg."</p>");?>
				</form>
			</fieldset>
			<fieldset <?php if(!$verified){echo ('disabled');}?>>
				<form class="login-info" action="/redi/signup-check.php" method="post" disabled="true">
					<input type="hidden" name="email" value="<?php echo($email)?>">
					<input type="text" name="userid" placeholder="userid" required><br/>
					<input type="password" name="password" placeholder="password" required><br/>
					<input type="submit" name="login-submit">
				</form>
			</fieldset>
		</fieldset>
	</main>
</body>
</html>