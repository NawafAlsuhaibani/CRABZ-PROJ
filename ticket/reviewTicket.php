<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/reset.css"/>
    <link rel="stylesheet" href="../css/layout.css"/>
    <link rel="stylesheet" href="../css/nav-header.css">
    <script type='text/javascript' src="../script/jquery-3.1.1.min.js"></script>
		<script type='text/javascript' src="../script/template.js"></script>
    <title>CRABZ-View Account Information</title>
  </head>
  <body class="bodyWrapper">
		<header id="header">
    </header>
    <div class="mainDivWrapper singleColumn-Margin">
      <main class="mainWrapper">
        <div class="small-pad bg-color-dark">
				<?php
					//if user has an admin account (boolean check?) we allow them see these links

					//$connection = mysqli_connect("localhost", "webuser", "", "crabzfake");//connect to dylans local database
					$connection = mysqli_connect("localhost", "crabz", "88yGu2XF", "crabz");//connect to real database

					$query = mysqli_query($connection, "SELECT * FROM ticket");
					$query2 = mysqli_query($connection, "SELECT * FROM ticket");

					echo('<h1 style="display:inline; font-size:44px;"><strong>Tickets</strong></h1><br>');

					echo('<table>');
					echo('<tr><th>Username</th><th>Email</th><th>Title of Ticket</th><th>Ticket Content</th></tr>');
					while($row = mysqli_fetch_array($query)){
						if($row["isTicket"]){
							echo '<tr><td>'.$row["ticketUserName"].'</td><td>'.$row["ticketEmail"].'</td><td>'.$row["ticketTitle"].'</td><td>'.$row["ticketContent"].'</td></tr>';
						}
					}
					echo('</table>');
					//start populating the feedback
					echo('<h1 style="display:inline; font-size:44px;"><strong>Feedback</strong></h1><br>');

					echo('<table>');
					echo('<tr><th>Username</th><th>Email</th><th>Title of Comment</th><th>Feedback Content</th></tr>');
					while($row = mysqli_fetch_array($query2)){
						if(!$row["isTicket"]){
							echo '<tr><td>'.$row["ticketUserName"].'</td><td>'.$row["ticketEmail"].'</td><td>'.$row["ticketTitle"].'</td><td>'.$row["ticketContent"].'</td></tr>';
						}
					}
					echo('</table>');

					echo '<br> <a href="../views/viewAccount.php">Go back</a>';
				?>
      </div>
      </main>
      <!--
      <nav class="rightColumn">
      </nav>
      <aside class="leftColumn">
      </aside>
      -->
    </div>
    <footer>
			Copyright © 2018
    </footer>
  </body>
</html>
