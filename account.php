<?php
	require_once('functions.php');
	if(!loggedin())
		header("Location: login.php");
	else
		include('header.php');
		connectdb();
?>
              <li><a href="index.php">Problems</a></li>
              <li><a href="submissions.php">Submissions</a></li>
              <li><a href="scoreboard.php">Scoreboard</a></li>
              <li class="active"><a href="#">Account</a></li>
		<li><a href="tutorial.php">Tutorial</a></li>
		<li><a href="practice.php">Practice</a></li>
              <li><a href="logout.php">Logout</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

    <div class="container">
    <?php
        if(isset($_GET['changed']))
          echo("<div class=\"alert alert-success\">\nAccount settings updated!\n</div>");
        else if(isset($_GET['passerror']))
          echo("<div class=\"alert alert-error\">\nThe old password you entered is wrong. Please enter the correct password and try again.\n</div>");
        else if(isset($_GET['derror']))
          echo("<div class=\"alert alert-error\">\nPlease enter all the details asked before you can continue!\n</div>");
    ?>
    Account settings for <?php echo($_SESSION['username']);?><hr/>
    	  <form method="post" action="update.php">
          <input type="hidden" name="action" value="password"/>
          <h1><small>Change Password</small></h1>
          Old password: <input type="password" name="oldpass"/><br/>
          New password: <input type="password" name="newpass"/><br/><br/>
          <input class="btn" type="submit" name="submit" value="Change Password"/>
          </form>
          <hr/>
          
          <form method="post" action="update.php">
          <input type="hidden" name="action" value="email"/>
          <h1><small>Change Email</small></h1>
          <?php
          	$query = "SELECT email FROM users WHERE username='".$_SESSION['username']."'";
          	$result = mysql_query($query);
          	$fields = mysql_fetch_array($result);
          ?>
          Email: <input type="email" name="email" value="<?php echo $fields['email'];?>"/><br/><br/>
          <input class="btn" type="submit" name="submit" value="Change Email"/>
          </form>
	  <hr/>
	  <form method="post" action="update.php">
          <input type="hidden" name="action" value="details"/>
          
          <?php
          	$query = "SELECT * FROM userprofile WHERE username='".$_SESSION['username']."'";
          	$result = mysql_query($query);
          	$fields = mysql_fetch_array($result);
          ?>
	  
	  <tr><th>
	  <h1><small>Change Details</small></h1><th/><tr/>
	  <tr><td>
          Country:</td><td><input type="text" name="country" value="<?php echo $fields['country'];?>"/></td></tr><br/><br/><tr><td>
          State:</td><td> <input type="text" name="state" value="<?php echo $fields['state'];?>"/></td></tr><br/><br/><tr><td>
	  City: </td><td><input type="text" name="city" value="<?php echo $fields['city'];?>"/></td></tr><br/><br/><tr><td>
	  Institution:</td><td> <input type="text" name="institution" value="<?php echo $fields['institution'];?>"/></td></tr><br/><br/><tr><td>
	  Gender:</td><td> <input type="text" name="gender" value="<?php echo $fields['gender'];?>"/></td></tr><br/><br/><tr><td>
	  About Me:</td><td> <input type="text" name="aboutme" value="<?php echo $fields['aboutme'];?>"/></td></tr><br/><br/>
	  
	  <br/>
	  <input class="btn" type="submit" name="submit" value="Change Details"/>
          </form>

		<hr/>

	  
    </div> <!-- /container -->

<?php
	include('footer.php');
?>
