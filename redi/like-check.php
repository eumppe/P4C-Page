<?php 
session_start();

if($_SESSION['idx']==null){
	header("Location: /pages/access-denied.php");
}

$pw=getenv('MySQLrootPW');
$conn=mysqli_connect('127.0.0.1','root', $pw,'eumppedb');
$idx=$_POST['idx'];
$user=$_SESSION['idx'];

$sql="SELECT * FROM like".$idx." WHERE user=".$_SESSION['idx'];
$result=mysqli_query($conn,$sql);
$i_like=(mysqli_fetch_array($result)!=null);

if($i_like){
	$sql="DELETE FROM like".$idx." WHERE user=".$user;
}else{
	$sql="INSERT INTO like".$idx." VALUE(".$user.")";
}
mysqli_query($conn, $sql);

header("Location: /pages/show-article.php?idx=".$idx);

?>