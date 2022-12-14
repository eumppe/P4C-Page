<?php 
session_start();
$pw=getenv('MySQLrootPW');
$conn=mysqli_connect('127.0.0.1','root', $pw,'eumppedb');
$forum=$_GET['forum'];
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
		<main class="william">
			<div class="list-top">
				<?php
				if($forum==1){
					echo("<h2 class='list-forum'>Notice</h2>");
				}else if($forum==2){
					echo("<h2 class='list-forum'>Community</h2>");
				}else if($forum==3){
					echo("<h2 class='list-forum'>Random</h2>");
				}else if($forum==4){
					echo("<h2 class='list-forum'>Questions</h2>");
				}
				?>
				<a class='write' href=<?php echo("'/pages/write-article.php?forum=".$forum."'");?>>write</a>
			</div>
			<table style="width:100%">
				<th class='table-title'>제목</th>
				<th class='table-author'>작성자</th>
				<th class='table-views'>조회수</th>
				<th class='table-times'>작성일</th>
				<?php

				$sql="SELECT * FROM articles WHERE forum=".$forum." ORDER BY times DESC";
				$result=mysqli_query($conn,$sql);

				while($row=mysqli_fetch_array($result)){

					echo("<tr class='list-content' onClick='location.href=\"/pages/show-article.php?idx=".$row['idx']."\"'>");

					echo("<td class='table-title'>");
					#echo("<a href=\"/pages/show-article.php?idx=".$row['idx']."\">");
					echo($row['title']);
					#echo("</a>");
					echo("</td>");

					$user_sql="SELECT userid FROM users WHERE idx=".$row['author'];
					$user_result=mysqli_query($conn,$user_sql);
					$user_row=mysqli_fetch_array($user_result);

					echo("<td class='table-author'>");	
					echo($user_row['userid']);
					echo("</td>");

					echo("<td class='table-views'>");
					echo($row['views']);
					echo("</td>");

					echo("<td class='table-times'>");	
					echo($row['times']);
					echo("</td>");

					echo("</tr>");
				}
				?>
			</table>
		</main>
		<footer>
			
		</footer>
	</body>
</html>