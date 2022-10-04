
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
			<fieldset>
				<form class="verify-email" action="/redi/verify-email.php" method="post">
					<input type="email" name="email" placeholder="email" required>
					<input type="submit" name="verify-email" value="verify">
				</form>
			</fieldset>
			<fieldset disabled>
				<form class="login-info" action="/redi/signup-check.php" method="post" disabled="true">
					<input type="text" name="userid" placeholder="userid" required><br/>
					<input type="password" name="password" placeholder="password" required><br/>
					<input type="submit" name="login-submit">
				</form>
			</fieldset>
		</fieldset>
	</main>
</body>
</html>