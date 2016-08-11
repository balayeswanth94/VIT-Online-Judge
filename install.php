<?php

	require_once('functions.php');
	if(isset($_POST['host'])) {
		// create file 'dbinfo.php'
		$fp = fopen('dbinfo.php','w');
		$l1 = '$host="'.$_POST['host'].'";';
		$l2 = '$user="'.$_POST['username'].'";';
		$l3 = '$password="'.$_POST['password'].'";';
		$l4 = '$database="'.$_POST['name'].'";';
		$l5 = '$compilerhost="'.$_POST['chost'].'";';
		$l6 = '$compilerport='.$_POST['cport'].';';
		fwrite($fp, "<?php\n$l1\n$l2\n$l3\n$l4\n$l5\n$l6\n?>");
		fclose($fp);
		include('dbinfo.php');
		// connect to the MySQL server
		mysql_connect("localhost","root","");
		// create the database
		mysql_query("CREATE DATABASE $database");
		mysql_select_db($database) or die('Error connecting to database.');
		// create the preferences table
		mysql_query("CREATE TABLE `prefs` (
  `name` varchar(30) NOT NULL,
  `accept` int(11) NOT NULL,
  `c` int(11) NOT NULL,
  `cpp` int(11) NOT NULL,
  `java` int(11) NOT NULL,
  `python` int(11) NOT NULL
)");
		// fill it with default preferences
		mysql_query("INSERT INTO `prefs` (`name`, `accept`, `c`, `cpp`, `java`, `python`) VALUES
('Codejudge', 1, 1, 1, 1, 1)");
		// create the problems table
		mysql_query("CREATE TABLE IF NOT EXISTS `problems` (
  `sl` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `text` text NOT NULL,
  `input` text NOT NULL,
  `output` text NOT NULL,
  `time` int(11) NOT NULL DEFAULT '3000',
  PRIMARY KEY (`sl`)
)");
		// create the solve table
		mysql_query("CREATE TABLE IF NOT EXISTS `solve` (
  `sl` int(11) NOT NULL AUTO_INCREMENT,
  `problem_id` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `attempts` int(11) NOT NULL DEFAULT '1',
  `soln` text NOT NULL,
  `filename` varchar(25) NOT NULL,
  `lang` varchar(20) NOT NULL,
  PRIMARY KEY (`sl`)
)");
		// create the users table
		mysql_query("CREATE TABLE IF NOT EXISTS `users` (
  `sl` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(25) NOT NULL,
  `salt` varchar(6) NOT NULL,
  `hash` varchar(80) NOT NULL,
  `email` varchar(100) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`sl`)
)");
		// create the ip_address table
		mysql_query("CREATE TABLE IF NOT EXISTS `ip_address` (
  `sl` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(250) NOT NULL,
  `ip` varchar(20) NOT NULL,
  `time` DATETIME,
  PRIMARY KEY (`sl`)
)");
	       // create the comment table
		$query="CREATE TABLE comments(cid int(5) primary key auto_increment,cmnt varchar(100),qid int(5),user varchar(20))";
		mysql_query($query);

	       //create userprofile table
		mysql_query("CREATE TABLE IF NOT EXISTS `userprofile` (
  `username` VARCHAR(25) NOT NULL ,
  `country` VARCHAR(25) NOT NULL , 
  `state` VARCHAR(25) NOT NULL , 
  `city` VARCHAR(25) NOT NULL ,
  `institution` VARCHAR(100) NOT NULL ,
  `gender` VARCHAR(1) NOT NULL ,
  `pincode` INT(10) NOT NULL ,
  `mobno` INT(10) NOT NULL ,
  `aboutme` VARCHAR(1000) NOT NULL ,
   PRIMARY KEY (`username`))");
		
		//create practice problem table
		mysql_query("CREATE TABLE IF NOT EXISTS `practice` (
  `sl` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `text` text NOT NULL,
  `input` text NOT NULL,
  `output` text NOT NULL,
  `time` int(11) NOT NULL DEFAULT '3000',
  PRIMARY KEY (`sl`)
)");
		mysql_query("ALTER TABLE `practice` CHANGE `time` `time` INT(11) NOT NULL DEFAULT '3000'");
				


		mysql_query("INSERT INTO `codejudge`.`practice` (`sl`, `name`, `text`, `input`, `output`, `time`) VALUES (NULL, 'ADDREV - Adding Reversed Numbers', 'The Antique Comedians of Malidinesia prefer comedies to tragedies. Unfortunately, most of the ancient plays are tragedies. Therefore the dramatic advisor of ACM has decided to transfigure some tragedies into comedies. Obviously, this work is very hard because the basic sense of the play must be kept intact, although all the things change to their opposites. For example the numbers: if any number appears in the tragedy, it must be converted to its reversed form before being accepted into the comedy play.

Reversed number is a number written in arabic numerals but the order of digits is reversed. The first digit becomes last and vice versa. For example, if the main hero had 1245 strawberries in the tragedy, he has 5421 of them now. Note that all the leading zeros are omitted. That means if the number ends with a zero, the zero is lost by reversing (e.g. 1200 gives 21). Also note that the reversed number never has any trailing zeros.

ACM needs to calculate with reversed numbers. Your task is to add two reversed numbers and output their reversed sum. Of course, the result is not unique because any particular number is a reversed form of several numbers (e.g. 21 could be 12, 120 or 1200 before reversing). Thus we must assume that no zeros were lost by reversing (e.g. assume that the original number was 12).
Input

The input consists of N cases (equal to about 10000). The first line of the input contains only positive integer N. Then follow the cases. Each case consists of exactly one line with two positive integers separated by space. These are the reversed numbers you are to add.
Output

For each case, print exactly one line containing only one integer - the reversed sum of two reversed numbers. Omit any leading zeros in the output.
Example

Sample input: 

3
24 1
4358 754
305 794

Sample output:

34
1998
1', '3
24 1
4358 754
305 794
234 43
1000 99', '34
1998
1
664
1', '3000')");



		mysql_query("UPDATE `codejudge`.`practice` SET `name` = 'COINS - Bytelandian gold coins', `text` = 'COINS - Bytelandian gold coins
#dynamic-programming

In Byteland they have a very strange monetary system.

Each Bytelandian gold coin has an integer number written on it. A coin n can be exchanged in a bank into three coins: n/2, n/3 and n/4. But these numbers are all rounded down (the banks have to make a profit).

You can also sell Bytelandian coins for American dollars. The exchange rate is 1:1. But you can not buy Bytelandian coins.

You have one gold coin. What is the maximum amount of American dollars you can get for it?
Input

The input will contain several test cases (not more than 10). Each testcase is a single line with a number n, 0 <= n <= 1 000 000 000. It is the number written on your coin.
Output

For each test case output a single line, containing the maximum amount of American dollars you can make.
Example

Input:
12
2

Output:
13
2

You can change 12 into 6, 4 and 3, and then change these into $6+$4+$3 = $13. If you try changing the coin 2 into 3 smaller coins, you will get 1, 0 and 0, and later you can get no more than $1 out of them. It is better just to change the 2 coin directly into $2.', `input` = '12
2
99
1020
', `output` = '13
2
120
1421' WHERE `practice`.`sl` = 2;");		







		// create the user 'admin' with password 'admin'
		$salt=randomAlphaNum(5);
		$pass="admin";
		$hash=crypt($pass,$salt);
		$sql="INSERT INTO `users` ( `username` , `salt` , `hash` , `email` ) VALUES ('$pass', '$salt', '$hash', '".$_POST['email']."')";
		mysql_query($sql);
		header("Location: install.php?installed=1");
	}
?>
<!DOCTYPE html>
<html lang="en"><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <title>VOJ Setup</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <style>
      body {
        padding-top: 60px; 
      }
      
      .footer {
        text-align: center;
        font-size: 11px;
      }
    </style>
    <link href="css/bootstrap-responsive.css" rel="stylesheet">
    <link rel="shortcut icon" href="http://twitter.github.com/bootstrap/assets/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="http://twitter.github.com/bootstrap/assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="http://twitter.github.com/bootstrap/assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="http://twitter.github.com/bootstrap/assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="http://twitter.github.com/bootstrap/assets/ico/apple-touch-icon-57-precomposed.png">
  </head>

  <body>

    <div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="#">VOJ Setup</a>
        </div>
      </div>
    </div>

    <div class="container">
    <?php
      if(isset($_GET['installed'])) {?>
        <div class="alert alert-success">VOJ is successfully installed!</div>
        
        You can login to the admin panel <a href="admin/">here</a> with the password <strong>admin</strong>. You can change it once you login to the admin panel.
    <?php  }else if(!file_exists("dbinfo.php")){ ?>
    Welcome to the VOJ setup. This will help you set up VOJ on your server. Make sure that you have MySQL running before you proceed.
    <h1><small>Details</small></h1>
    <form action="install.php" method="post">
    Database Host: <input type="text" name="host" value="localhost"/><br/>
    Username: <input type="text" name="username"/><br/>
    Password: <input type="password" name="password"/><br/>
    Database Name: <input type="text" name="name" value="codejudge"/><br/>
    Email: <input type="email" name="email"/><br/>
    Compiler Server Host: <input type="text" name="chost" value="localhost"/><br/>
    Compiler Server Port: <input type="text" name="cport" value="3029"/><br/>
    <input type="submit" class="btn btn-primary" value="Install"/>
    </form>
    <?php } else {?>
      <div class="alert alert-error">VOJ is already installed. Please remove the files and re-install it.</div>
    <?php } ?>
    </div> <!-- /container -->

<?php
	include('footer.php');
?>
