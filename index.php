<?php 
session_start();
$pw=getenv('MySQLrootPW');
$conn=mysqli_connect('127.0.0.1','root', $pw,'eumppedb');
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>Eumppe</title>
		<link rel="stylesheet" href="./css/main.css" type="text/css">
	</head>
	<body>
		<div>
			<header>
				<section class="home-header wilson">
					<a href="/index.php">
						<img class="home-header-icon" src="/img/eumppe.png"/>
					</a>
					<div class="home-header-right">
						<div class="home-header-bottom">
							<ul class="home-header-bottom-button">
								<li><a href="/pages/article-list.php?forum=1">Notice</a></li>
								<li><a href="/pages/article-list.php?forum=2">Community</a></li>
								<li><a href="/pages/article-list.php?forum=3">Random</a></li>
								<li><a href="/pages/article-list.php?forum=4">Questions</a></li>
							</ul>
						</div>
						<div class="home-header-upper">
							<form class="search" action="/pages/search.php">
								<input class="search-index" type="text" name="search-keyword">
								<input type="image" src="/img/search.png" alt="검색" style="width:1.5rem;height:1.5rem;">
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
					</div>
				</section>
			</header>
			<main>
				<div class="home-banner wilson">
					<img src='/img/banner1.png' alt="banner1">
				</div>
				<section class="home-recentnews wilson">
					<h2>Recent Articles</h2>
					<ul>
						<?php
						$sql="SELECT * FROM articles ORDER BY times DESC LIMIT 5";
						$result=mysqli_query($conn,$sql);
						while($row=mysqli_fetch_array($result)){
							echo("<li><a href='/pages/show-article.php?idx=".$row['idx']."'>".$row['times']." | ".$row['title']."</a></li>");
						}
						?>
					</ul>
				</section>
			</main>
		</div>
			<footer>
				
			</footer>
	</body>
</html>