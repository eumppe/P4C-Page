<?php 
session_start();
$pw=getenv('MySQLrootPW');
$conn=mysqli_connect('127.0.0.1','root', $pw,'eumppedb');
$idx=$_POST['idx'];

$sql="INSERT INTO comment".$idx."(writer, content) VALUES
(".$_SESSION['idx'].",
'".$_POST['comment']."')";
mysqli_query($conn,$sql);

header("Location: /pages/show-article.php?idx=".$idx);
?>