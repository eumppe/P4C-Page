
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
			<img src="/img/eumppe.png"/>
		</section>
	</header>
	<main>
		<form class="login-info" action="/redi/signup-check.php" method="post">
			<fieldset>
				<legend>Signup</legend>
				<input type="text" name="userid" placeholder="userid" required>
				<input type="password" name="password" placeholder="password" required>
				<input type="email" name="email" placeholder="email" required>
				<input type="submit" name="login-submit">
			</fieldset>
		</form>
	</main>
</body>
</html>