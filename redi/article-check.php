<?php 
session_start();
$pw=getenv('MySQLrootPW');
$conn=mysqli_connect('127.0.0.1','root', $pw,'eumppedb');

#save file part1
if($_FILES['file']['name']!=null){
	$tmp_name = $_FILES["file"]["tmp_name"];
	$name = basename($_FILES["file"]["name"]);
}

#save article

$sql="INSERT INTO articles(
	forum,
	author,
	title,
	article,
	files
	) VALUES("
	.$_POST['forum'].", "
	.$_SESSION['idx'].", '"
	.$_POST['title']."', '"
	.$_POST['article']."', '"
	.$name."')";
mysqli_query($conn,$sql);

$article_id=$conn->insert_id;

#save file2
if($_FILES['file']['name']!=null){
	$uploads_dir = '../uploads/'.$article_id;
	mkdir(
	    $uploads_dir, 0777, true, null);
	move_uploaded_file($tmp_name, "$uploads_dir/$name");
}


#create comment table
$sql="CREATE TABLE comment".$article_id."(
idx INT PRIMARY KEY AUTO_INCREMENT,
writer INT NOT NULL,
content VARCHAR(300) CHARACTER SET utf8mb4 NOT NULL,
times timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
)";
mysqli_query($conn,$sql);

#create view table
$sql="CREATE TABLE view".$article_id."(
ip INT PRIMARY KEY,
times timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
)";
mysqli_query($conn,$sql);

#create like table
$sql="CREATE TABLE like".$article_id."(
user INT PRIMARY KEY
)";
mysqli_query($conn,$sql);

#redirection
header("Location: /pages/article-list.php?forum=".$_POST['forum']);
?>