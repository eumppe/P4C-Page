<?php 
session_start();
$pw=getenv('MySQLrootPW');
$conn=mysqli_connect('127.0.0.1','root', $pw,'eumppedb');

$search_type=$_GET['search_type'];#1: title, 2: content, 3: title&content
$forum=$_GET['forum'];#1~4: each forum, 5: all
$search_keyword=$_GET['search-keyword'];

$forum_list=['','Notice', 'Community', 'Random', 'Questions'];

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
			<form class="search-main" action="/pages/search.php" method="get">
				<input type="text" name="search-keyword" <?php echo("value='".$search_keyword)."'";?>>
				<input type="submit" name="search-submit">
				<h4>forum</h4>
				<label><input type="radio" name="forum" value="5" id="choice2" <?php if($forum==5 || $forum==null){echo("checked");}?>>All</label>
				<label><input type="radio" name="forum" value="1" id="choice1" <?php if($forum==1){echo("checked");}?>>Notice</label>
				<label><input type="radio" name="forum" value="2" id="choice2" <?php if($forum==2){echo("checked");}?>>Community</label>
				<label><input type="radio" name="forum" value="3" id="choice1" <?php if($forum==3){echo("checked");}?>>Random</label>
				<label><input type="radio" name="forum" value="4" id="choice2" <?php if($forum==4){echo("checked");}?>>Questions</label>
				<br/>
				<h4>검색 기준</h4>
				<label><input type="radio" name="search_type" value="3" id="choice2" <?php if($search_type==3|| $search_type==null){echo("checked");}?>>제목, 내용</label>
				<label><input type="radio" name="search_type" value="1" id="choice2" <?php if($search_type==1){echo("checked");}?>>제목</label>
				<label><input type="radio" name="search_type" value="2" id="choice2" <?php if($search_type==2){echo("checked");}?>>내용</label>
				<br/>
			</form>
			<?php
				#processing search
				$sql="SELECT * FROM articles WHERE (";
				$keywords=explode(' ', $search_keyword);
				$notbegin=false;
				if($search_type==1){
					foreach($keywords as $kw){
						if($notbegin){
							$sql=$sql." OR";
						}else{
							$notbegin=true;
						}
						$sql=$sql." title like '%".$kw."%'";
					}
				}else if($search_type==2){
					foreach($keywords as $kw){
						if($notbegin){
							$sql=$sql." OR";
						}else{
							$notbegin=true;
						}
						$sql=$sql." article like '%".$kw."%'";
					}
				}else if($search_type==3 || $search_type==null){
					foreach($keywords as $kw){
						if($notbegin){
							$sql=$sql." OR";
						}else{
							$notbegin=true;
						}
						$sql=$sql." title like '%".$kw."%' OR article like '%".$kw."%'";
					}
				}
				if($forum!=5 && $forum!=null){
					$sql=$sql.") AND forum=".$forum." ORDER BY times DESC";
				}else{
					$sql=$sql.") ORDER BY times DESC";
				}

				$result=mysqli_query($conn,$sql);
			?>
			<table>
				<th>검색 결과</th>
				<?php
				

				while($row=mysqli_fetch_array($result)){

					echo("<tr>");

					echo("<td>");
					echo("<a href=\"/pages/show-article.php?idx=".$row['idx']."\">");
					echo($row['title']);
					echo("</a>");
					echo("</td>");

					$user_sql="SELECT userid FROM users WHERE idx=".$row['author'];
					$user_result=mysqli_query($conn,$user_sql);
					$user_row=mysqli_fetch_array($user_result);

					echo("<td>");	
					echo("작성자 : ".$user_row['userid']);
					echo("</td>");

					echo("<td>");	
					echo("게시판 : ".$forum_list[$row['forum']]);
					echo("</td>");

					echo("<td>");	
					echo("조회수 : ".$row['views']);
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