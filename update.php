<?php

	include('functions.php');
	connectdb();
	if($_POST['action']=='email') {
		// change the email id of the user
		if(trim($_POST['email']) == "")
			header("Location: account.php?derror=1");
		else {
			mysql_query("UPDATE users SET email='".mysql_real_escape_string($_POST['email'])."' WHERE username='".$_SESSION['username']."'");
			header("Location: account.php?changed=1");
		}
	} else if($_POST['action']=='password') {
		// change the password of the user
		if(trim($_POST['oldpass']) == "" or trim($_POST['newpass']) == "")
			header("Location: account.php?derror=1");
		else {
			$query = "SELECT salt,hash FROM users WHERE username='".$_SESSION['username']."'";
			$result = mysql_query($query);
			$fields = mysql_fetch_array($result);
			$currhash = crypt($_POST['oldpass'], $fields['salt']);
			if($currhash == $fields['hash']) {
				$salt = randomAlphaNum(5);
				$newhash = crypt($_POST['newpass'], $salt);
				mysql_query("UPDATE users SET hash='$newhash', salt='$salt' WHERE username='".$_SESSION['username']."'");
				header("Location: account.php?changed=1");
			} else
				header("Location: account.php?passerror=1");
		}
	} else if($_POST['action']=="details"){
		// change the user details
		if(trim($_POST['country'])=="" or trim($_POST['state'])=="" or trim($_POST['city'])=="" or trim($_POST['institution'])=="" or trim($_POST['gender'])=="" or trim($_POST['aboutme'])=="")
			header("Location: account.php?derror=1");
		else{
			mysql_query("UPDATE userprofile SET country='".$_POST['country']."' WHERE username='".$_SESSION['username']."'");
			mysql_query("UPDATE userprofile SET state='".$_POST['state']."' WHERE username='".$_SESSION['username']."'");	
			mysql_query("UPDATE userprofile SET city='".$_POST['city']."' WHERE username='".$_SESSION['username']."'");
			mysql_query("UPDATE userprofile SET institution='".$_POST['institution']."' WHERE username='".$_SESSION['username']."'");
			mysql_query("UPDATE userprofile SET gender='".$_POST['gender']."' WHERE username='".$_SESSION['username']."'");
			mysql_query("UPDATE userprofile SET aboutme='".$_POST['aboutme']."' WHERE username='".$_SESSION['username']."'");
			header("Location: account.php?changed=1");
		}
	}			
?>
