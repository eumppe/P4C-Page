<?php 
session_start();
$pw=getenv('MySQLrootPW');
$conn=mysqli_connect('127.0.0.1','root', $pw,'eumppedb');


$sql="INSERT INTO articles(
	forum,
	author,
	title,
	article
	) VALUES("
	.$_POST['forum'].", "
	.$_SESSION['idx'].", '"
	.$_POST['title']."', '"
	.$_POST['article']."')";
mysqli_query($conn,$sql);

$article_id=$conn->insert_id;

$sql="CREATE TABLE comment".$article_id."(
idx INT PRIMARY KEY AUTO_INCREMENT,
writer INT NOT NULL,
content VARCHAR(300) CHARACTER SET utf8mb4 NOT NULL,
times timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
)";
mysqli_query($conn,$sql);

$sql="CREATE TABLE view".$article_id."(
ip INT PRIMARY KEY,
times timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
)";
mysqli_query($conn,$sql);

$sql="CREATE TABLE like".$article_id."(
user INT PRIMARY KEY
)";
mysqli_query($conn,$sql);

header("Location: /pages/article-list.php?forum=".$_POST['forum']);
?>