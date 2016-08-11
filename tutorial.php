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
              <li><a href="account.php">Account</a></li>
              <li class="active"><a href="#">Tutorial</a></li>
		<li><a href="practice.php">Practice</a></li>
              <li><a href="logout.php">Logout</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>
    <div class="container">
    Click on links to access various tutorials
    <table class="table table-striped">
      <thead><tr>
        <th>S.No</th>
        <th>Name</th>
        <th>Link</th>
      </tr></thead>
      <tbody>
      <?php
        $query = "SELECT sno, name, link FROM tuto WHERE sno!='0'";
        $result = mysql_query($query);
        $link;
        while($row = mysql_fetch_array($result)) {
          $link = $row['link'];
          echo("<tr><td>".$row['sno']." ");
          echo("</td><td>".$row['name']);
          echo("</td><td><span class=\"badge badge-success\"><a href =\"$link\">Click</span></td></tr>");
        }
      ?>
      </tbody>
      </table>
    </div> <!-- /container -->
