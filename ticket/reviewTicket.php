<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Ticket Review</title>
		<meta charset="utf-8">
	</head>
	<body>
		<header>
			<h1 style="display:inline; font-size:44px;"><strong>Ticket Review</strong></h1>
		</header>
		<?php
			//if user has an admin account (boolean check?) we allow them see these links

			//$connection = mysqli_connect("localhost", "webuser", "", "crabzfake");//connect to dylans local database
			$connection = mysqli_connect("localhost", "crabz", "88yGu2XF", "crabz");//connect to real database

			$query = mysqli_query($connection, "SELECT * FROM ticket");
			$query2 = mysqli_query($connection, "SELECT * FROM ticket");

			echo('TICKETS <br>');

			echo('<table>');
			echo('<tr><th>Username</th><th>Email</th><th>Title of Ticket</th><th>Ticket Content</th></tr>');
			while($row = mysqli_fetch_array($query)){
				if($row["isTicket"]){
					echo '<tr><td>'.$row["ticketUserName"].'</td><td>'.$row["ticketEmail"].'</td><td>'.$row["ticketTitle"].'</td><td>'.$row["ticketContent"].'</td></tr>';
				}
			}
			echo('</table>');
			//start populating the feedback
			echo('FEEDBACK <br>');

			echo('<table>');
			echo('<tr><th>Username</th><th>Email</th><th>Title of Comment</th><th>Feedback Content</th></tr>');
			while($row = mysqli_fetch_array($query2)){
				if(!$row["isTicket"]){
					echo '<tr><td>'.$row["ticketUserName"].'</td><td>'.$row["ticketEmail"].'</td><td>'.$row["ticketTitle"].'</td><td>'.$row["ticketContent"].'</td></tr>';
				}
			}
			echo('</table>');

			echo '<br> <a href="../Account/Account.php">Go back</a>';
		?>

		<footer>
		Copyright © 2018
		</footer>

	</body>
</html>
