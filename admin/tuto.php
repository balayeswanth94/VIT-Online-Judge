<?php

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
              <li class="tuto"><a href="#">Add Tutorials</a></li>
		<li><a href="sup.php">Suspicious users</a></li>
              <li><a href="logout.php">Logout</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>
  <?php
        if(isset($_GET['changed']))
          echo("<div class=\"alert alert-success\">\nAccount settings updated!\n</div>");
        else if(isset($_GET['passerror']))
          echo("<div class=\"alert alert-error\">\nThe old password you entered is wrong. Please enter the correct password and try again.\n</div>");
        else if(isset($_GET['derror']))
          echo("<div class=\"alert alert-error\">\nPlease enter all the details asked before you can continue!\n</div>");
        else if(isset($_GET['detrror']))
          echo("<div class=\"alert alert-error\">\nPlease enter all the user details asked before you can continue!\n</div>");
    ?>
<div class="container">
        <form method="post" action="update1.php">
          <input type="hidden" name="action" value="updatetuto"/>
          <h1><small>Upload Tutorials</small></h1>
          Name <input type="text" name="name"/><br/>
          Link: <input type="text" name="link"/><br/><br/>
          <input class="btn" type="submit" name="submit" value="Update Tutorial"/>
          </form>
          <hr/>
</div>

<?php
  include('footer.php');
?>
