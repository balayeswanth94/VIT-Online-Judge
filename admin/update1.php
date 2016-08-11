<?php
include('../functions.php');
	connectdb();
if(isset($_POST['action'])){

if($_POST['action']=='updatetuto') {
		// change the email id of the user
		if(trim($_POST['name']) == "")
			header("Location: tuto.php?detrror=1");
		if(trim($_POST['link']) == "")
			header("Location: tuto.php?detrror=1");
		else {
			$query="INSERT INTO `tuto` (`name` , `link`) VALUES ('".mysql_real_escape_string($_POST['name'])."', '".mysql_real_escape_string($_POST['link'])."')";
			mysql_query($query);
			header("Location: tuto.php?changed=1");

		}
	}
}
	?>
