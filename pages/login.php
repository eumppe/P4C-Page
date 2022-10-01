
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login-Eumppe</title>
	<link rel="stylesheet" type="text/css" href="/css\main.css">
</head>
<body>
	<header>
		<section class="login-header">
			<img src="/img/eumppe.png"/>
		</section>
	</header>
	<main>
		<form class="login-info" action="/redi/login-check.php" method="post">
			<fieldset>
				<legend>Login</legend>
				<input type="text" name="userid" placeholder="userid">
				<input type="password" name="password" placeholder="password">
				<input type="submit" name="login-submit">
			</fieldset>
		</form>
	</main>
</body>
</html>