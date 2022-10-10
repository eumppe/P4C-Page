
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login-Eumppe</title>
	<link rel="stylesheet" type="text/css" href="/css/main.css">
</head>
<body>
	<header>
		<section class="login-header">
			<a href="/index.php">
					<img class=" home-header-icon"src="/img/eumppe.png"/>
				</a>
		</section>
	</header>
	<main>
		<fieldset class="login-fieldset">
			<legend class="login-legend">Login</legend>
			<form class="login-info" action="/redi/login-check.php" method="post">
				<div class="login-account-info">
					<input class="login-userid" type="text" name="userid" placeholder="userid">
					<input class="login-userid" type="password" name="password" placeholder="password">
				</div>
				<input class="login-final-submit" type="submit" name="login-submit" value="Login">
			</form>
			<p><?php echo ("<div class='login-msg'>".$_GET['msg']."</div>")?></p>
		</fieldset>
	</main>
</body>
</html>