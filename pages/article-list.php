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
		<main>
			<a href="/pages/write-article.php">write</a>
			<table>
				<?php
				$forum=$_GET['forum'];
				if($forum==1){
					echo("<th>Notice</th>");
				}else if($forum==2){
					echo("<th>Community</th>");
				}

				$sql="SELECT * FROM articles WHERE forum=".$forum." LIMIT 10";
				$result=mysqli_query($conn,$sql);

				for($i=0;$i<mysqli_num_rows($result);$i++){
					$row=mysqli_fetch_array($result);

					echo("<tr>");

					echo("<td>");
					echo("<a href=\"/pages/show-article.php?idx=".$row['idx']."\">");
					echo($row['title']);
					echo("</a>");
					echo("</td>");

					echo("<td>");	
					echo($row['times']);
					echo("</td>");

					echo("</a>");
					echo("</tr>");
				}
				?>
			</table>
		</main>
		<footer>
			
		</footer>
	</body>
</html>