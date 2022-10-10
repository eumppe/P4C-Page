<?php 
session_start();
$pw=getenv('MySQLrootPW');
$conn=mysqli_connect('127.0.0.1','root', $pw,'eumppedb');
$idx=$_GET['idx'];

$sql="SELECT * FROM like".$idx;
$like_result=mysqli_query($conn,$sql);
$total_like=mysqli_num_rows($like_result);

if($_SESSION['idx']!=null){
	$sql="SELECT * FROM like".$idx." WHERE user=".$_SESSION['idx'];
	$result=mysqli_query($conn,$sql);
	$i_like=(mysqli_fetch_array($result)!=null);
}

#count view
$update_view=false;

$ip=$_SERVER['REMOTE_ADDR'];
$sql="SELECT * FROM view".$idx." WHERE ip= (INET_ATON('".$ip."'))";
$result=mysqli_query($conn,$sql);
if($row=mysqli_fetch_array($result)){
	$sql="SELECT TIMESTAMPDIFF(HOUR,'".$row['times']."',NOW())";
	$result=mysqli_query($conn, $sql);
	$time_diff_row=mysqli_fetch_array($result);

	if($time_diff_row[0]>0){
		$update_view=true;
		$sql="UPDATE view".$idx." SET times=NOW() WHERE ip=(INET_ATON('".$ip."'))";
		mysqli_query($conn,$sql);
	}

}else{
	$update_view=true;
	$sql="INSERT INTO view".$idx."(ip) VALUES(INET_ATON('".$ip."'))";
	mysqli_query($conn,$sql);
}

if($update_view){
	$sql="UPDATE articles SET views=views+1 WHERE idx=".$idx;
	mysqli_query($conn,$sql);
}
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
			<?php
			$sql="SELECT * FROM articles WHERE idx=".$idx;
			$result=mysqli_query($conn, $sql);
			$row=mysqli_fetch_array($result);
			$forum=$row['forum'];
			echo('<a href="/pages/article-list.php?forum='.$forum.'"><div class="show-forum">');
			if($forum==1){
				echo("<h3>Notice</h3>");
			}else if($forum==2){
				echo("<h3>Community</h3>");
			}else if($forum==3){
				echo("<h3>Random</h3>");
			}else if($forum==4){
				echo("<h3>Questions</h3>");
			}
			echo('</div></a>');


			$user_sql="SELECT userid FROM users WHERE idx=".$row['author'];
			$user_result=mysqli_query($conn,$user_sql);
			$user_row=mysqli_fetch_array($user_result);

			echo ("<div class='show-arcitle-title'>".$row['title']."</div>");
			echo("<div class='show-arcitle-meta'>");
			echo ("<p> 작성자: ".$user_row['userid']."</p>");
			echo ("<p> 작성일: ".$row['times']."</p>");
			echo ("<p> 조회수: ".$row['views']."</p>");
			echo('</div><br>');

			if ($row['files']!=null){
				echo("<div class='show-file'>");
				echo ("Attached file: <a href='/uploads/".$idx."/".$row['files']."'>".$row['files']."</a>");
				echo("</div><br>");
			}

			echo ("<div class='article'> ".nl2br($row['article'])."</div>");


			?>
			<!--like-->
		<form class="like" action="/redi/like-check.php" method="post">
			<input type="hidden" name="idx" value="<?php echo($idx);?>">
			<input class="like-btn" type="submit" name="like" value="like: <?php echo($total_like);?>" <?php if($i_like){echo("style='background-color: red;'");}?>>
		</form>
			<!--Comments-->
			<!--write-->
		<form class="comment-write" action="/redi/comment-check.php" method="post">
			<?php
			if($_SESSION["userid"]!=null){
				echo('
				<input type="hidden" name="idx" value="'. ($_GET['idx']).'">
				<textarea class="comment-input" name="comment"></textarea><br/>
				<input class="comment-submit" type="submit" name="comment-submit" value="작성">');
			}
			?>
		</form>
			<div class="comments">
			<!--show-->
			<?php 
			$sql="SELECT * FROM comment".$idx;
			$result=mysqli_query($conn, $sql);

			while($row=mysqli_fetch_array($result)){
				$user_sql="SELECT userid FROM users WHERE idx=".$row['writer'];
				$user_result=mysqli_query($conn,$user_sql);
				$user_row=mysqli_fetch_array($user_result);
				echo("<div class='comment-single'><div class='comment-meta'><p class='comment-userid'>".$user_row['userid'].
					"</p><p class='comment-times'>".$row['times']."</p></div>");
				echo("<p class='comment-content'>".$row['content']."</p></div>
					<hr>");
			}
			?>
			</div>
		</main>
		<footer>
			
		</footer>
	</body>
</html>