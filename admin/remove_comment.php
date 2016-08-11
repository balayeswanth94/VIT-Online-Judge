<?php
session_start();
$server = "localhost";
$userdb = "root";
$userpass = "";
$database = "codejudge";
$con = mysqli_connect($server, $userdb, $userpass, $database) or die(mysqli_connect_error());
$checkbox = $_POST['check'];

for($i=0;$i<count($checkbox);$i++){

$del_id = $checkbox[$i];
//echo "$del_id";
$id=$_SESSION['pid'];
//echo $id;
$sql = "DELETE FROM comments WHERE cid='$del_id'";
$result = mysqli_query($con,$sql);
echo "<script>location.href = \"problems.php?action=edit&id=$id\";</script>";
}
?>
