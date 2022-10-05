<?php
session_start();
if($_SESSION["userid"]==null){
	header("Location: /pages/access-denied.php");
}
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
		<form action="/redi/article-check.php" method="post">
			<label><input type="radio" name="forum" value="1" id="choice1" checked>Notice</label>
			<label><input type="radio" name="forum" value="2" id="choice2">Community</label>
			<br/>
			title:<input type="text" name="title"><br/>
			<textarea name="article"></textarea><br/>
			<input type="file" name="file" multiple><br/>
			<input type="submit" name="article-submit">
		</form>
	</main>
</body>
</html>