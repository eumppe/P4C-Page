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
			title:<input type="text" name="title"><br/>
			<textarea name="article"></textarea>
			<input type="submit" name="article-submit">
		</form>
	</main>
</body>
</html>