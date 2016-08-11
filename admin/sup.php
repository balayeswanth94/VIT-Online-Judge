<?php
	error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
	require_once('../functions.php');
	if(!loggedin())
		header("Location: login.php");
	else if($_SESSION['username'] !== 'admin')
		header("Location: login.php");
	else
		include('header.php');
		connectdb();
?>
              <li><a href="index.php">Admin Panel</a></li>
              <li><a href="users.php">Users</a></li>
	      <li><a href="tuto.php">Add Tutorials</a></li>
	      <li class="active"><a href="#">Suspicious users</a></li>
              <li><a href="logout.php">Logout</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>


<div class="container">
Below is a list of users loged in with multiple IP. You can view the details of the user or ban him.
<table class="table table-striped">
      <thead><tr>
        <th>Name</th>
        <th>ip</th>
      </tr></thead>
	<tbody>
<?php

 $query = "SELECT username,count(username) FROM ip_address GROUP BY username";
        $result = mysql_query($query);
       	while($row = mysql_fetch_array($result)) 
        {
	if($row[1]>1)
	{
	 //echo("<tr><td><font color='red'>".$row['username']."</font></td>");
	echo("<tr><td><a href=\"profile.php?uname=".$row['username']."\">".$row['username']);	 
	$query1="SELECT ip FROM ip_address WHERE username='".$row[0]."'";
	 $result1=mysql_query($query1);
	 $all_ip=" ";
	 while($row1=mysql_fetch_array($result1))
	 {
	  $all_ip.=$row1[0].' , ';
	 }//while ip
	$all_ip=substr_replace($all_ip,"",-2);
	 //trim($all_ip,",");
	 echo("<td>".$all_ip."</td></tr>");
	}//if count>1
	}//while top
	?>
</tbody>
</table>

Below is a list of who has submitted same code. You can view the details of the user or ban him.
<table class="table table-striped">
      <thead><tr>
        <th>Name</th>
        <th>Problem</th>
      </tr></thead>
	<tbody>
<?php
$content=file_get_contents("ban.txt");

$content1=explode("\n",$content);
$arr=array();
$j=0;
$size=count($content1);
foreach($content1 as $temp )
{
$j++;
if($j==$size)
{
break;
}
$i=0;
$temp1=explode(" ",$temp);
foreach($temp1 as $temp2)
{
$arr[$i]=$temp2;
$i++;
}
echo("<tr><td>");
echo("<a href=\"profile.php?uname=".$arr[0]."\">".$arr[0]);
echo("</a>,");
echo(" <a href=\"profile.php?uname=".$arr[1]."\">".$arr[1]);
echo("</a>");
echo("</td>");
echo("<td>");
$query9 = "SELECT * FROM problems WHERE sl='".$arr[2]."'";
        $result9 = mysql_query($query9);
$row9 = mysql_fetch_array($result9);


echo(" <a href=\"problems.php?action=edit&id=".$arr[2]."\">".$row9['name']);
echo("</a>");
echo("</td></tr>");
}
?>

</div>
<?php
	include('footer.php');
?>
