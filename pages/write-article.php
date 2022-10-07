<?php
session_start();
if($_SESSION["userid"]==null){
	header("Location: /pages/access-denied.php");
}
$forum=$_GET['forum'];
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Article-Eumppe</title>
	<link rel="stylesheet" type="text/css" href="/css/main.css">
</head>
<body>
	<header>
		<section class="login-header">
			<a href="/index.php">
					<img class=" home-header-icon"src="/img/Eumppe.png"/>
				</a>
		</section>
	</header>
	<main>
		<form action="/redi/article-check.php" method="post" enctype="multipart/form-data">
			<label><input type="radio" name="forum" value="1" id="choice1" <?php if($forum==1){echo("checked");}?>>Notice</label>
			<label><input type="radio" name="forum" value="2" id="choice2" <?php if($forum==2 || $forum==null){echo("checked");}?>>Community</label>
			<label><input type="radio" name="forum" value="3" id="choice1" <?php if($forum==3){echo("checked");}?>>Random</label>
			<label><input type="radio" name="forum" value="4" id="choice2" <?php if($forum==4){echo("checked");}?>>Questions</label>
			<br/>
			title:<input type="text" name="title"><br/>
			<textarea class="article-input" name="article"></textarea><br/>
			<input type="hidden" name="MAX_FILE_SIZE" value="2097152" />
			<input type="file" name="file"><br/>
			<input type="submit" name="article-submit">
		</form>
	</main>
</body>
</html>