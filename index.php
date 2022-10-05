<?php 
session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>Eumppe</title>
		<link rel="stylesheet" href="/css/main.css">
	</head>
	<body>
		<header>
			<section class="home-header">
				<a href="/index.php">
					<img class=" home-header-icon"src="/img/Eumppe.png"/>
				</a>
				<div class="home-header-right">
					<div class="home-header-upper">
						<form class="search" action="/pages/search.php">
							<input type="text" name="search-keyword">
							<input type="button" name="search-submit">
						</form>
						<div class="home-header-upper-auth">
							<?php
							if ($_SESSION==null){
								echo '<a href="/pages/login.php">login</a>
								<a href="/pages/signup.php">sign up</a>';
							}else{
								echo '<a href="/redi/logout.php">logout</a>';
							}
							?>
						</div>
					</div>
					<div class="home-header-bottom">
						<ul class="home-header-bottom-button">
							<li><a href="/pages/article-list.php?forum=1">Notice</a></li>
							<li><a href="/pages/article-list.php?forum=2">Community</a></li>
							<li><a href="">menu 3</a></li>
							<li><a href="">menu 4</a></li>
						</ul>
					</div>
				</div>
			</section>
		</header>
		<div class="home-banner">
			
		</div>
		<main>
			<section class="home-recentnews">
				<h2>Recent News</h2>
				<ul>
					<li><a href="">news title 1</a></li>
					<li><a href="">news title 2</a></li>
					<li><a href="">news title 3</a></li>
				</ul>
			</section>
		</main>
		<footer>
			
		</footer>
	</body>
</html>