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


header("Location: /pages/article-list.php?forum=".$_POST['forum']);
?>