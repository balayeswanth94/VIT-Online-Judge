<?php
session_start();
$server = "localhost";
$userdb = "root";
$userpass = "";
$database = "codejudge";
$con = mysqli_connect($server, $userdb, $userpass, $database) or die(mysqli_connect_error());
//$query="create table comments(cid int(5) primary key auto_increment,cmnt varchar(100),qid int(5),user varchar(20))";
//mysqli_query($con,$query);
$cmnt=$_POST['cmnt'];
$id=$_SESSION['id'];
$user=$_SESSION['username'];
if($cmnt!='')
mysqli_query($con,"insert into comments(cmnt,qid,user) values('$cmnt',$id,'$user')");
echo "<script>location.href = \"index.php?id=$id\";</script>";
?>
