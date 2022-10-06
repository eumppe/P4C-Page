<?php 
session_start();
$pw=getenv('MySQLrootPW');
$conn=mysqli_connect('127.0.0.1','root', $pw,'eumppedb');
$idx=$_GET['idx'];
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
							<li><a href="/pages/article-list.php?forum=3">Random</a></li>
							<li><a href="/pages/article-list.php?forum=4">Questions</a></li>
						</ul>
					</div>
				</div>
			</section>
		</header>
		<main>
			<?php
			$sql="SELECT * FROM articles WHERE idx=".$idx;
			$result=mysqli_query($conn, $sql);
			$row=mysqli_fetch_array($result);

			$forum=$row['forum'];
			if($forum==1){
				echo("<h3>Notice</h3>");
			}else if($forum==2){
				echo("<h3>Community</h3>");
			}else if($forum==3){
				echo("<h3>Random</h3>");
			}else if($forum==4){
				echo("<h3>Questions</h3>");
			}


			$user_sql="SELECT userid FROM users WHERE idx=".$row['author'];
			$user_result=mysqli_query($conn,$user_sql);
			$user_row=mysqli_fetch_array($user_result);

			echo ("<h1>".$row['title']."</h1>");
			echo ("<p> 작성자: ".$user_row['userid']."</p>");
			echo ("<p> 작성일: ".$row['times']."</p>");

			echo ("<div> ".nl2br($row['article'])."</div>");


			?>
		</main>
		<footer>
			
		</footer>
	</body>
</html>