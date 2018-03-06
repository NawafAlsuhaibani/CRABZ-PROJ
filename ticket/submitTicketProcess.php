<?php
	$name = $_POST["name"];
	$email = $_POST["email"];
	$subject = $_POST["subject"];
	$content = $_POST["commentArea"];
	$isTicket = $_POST["isTicket"];// isTicket is just a string that says true --->"true" NOT A BOOLEAN
	if($isTicket == "true"){$isTicket = true;} //making $isTicket a boolean
	else{$isTicket = false;}
	
	if($name == ""){$name = null;} 
	if($email == ""){$email = null;} 
	if($content == ""){$content = null;} 
	
	$connection = mysqli_connect("localhost", "webuser", "", "crabzfake");//connect to dylans local database
	//$connection = mysqli_connect("localhost", "crabz", "88yGu2XF", "crabz");//connect to real database
	
	if($isTicket){
		echo('Ticket Submitted');
		$query = mysqli_query($connection, "INSERT INTO ticket (ticketUserName,ticketEmail,ticketTitle,ticketContent,isTicket) VALUES ('$name','$email','$subject','$content',true)");
		
	}
	else{
		echo('Feedback Submitted');
		$query2 = mysqli_query($connection, "INSERT INTO ticket (ticketUserName,ticketEmail,ticketTitle,ticketContent,isTicket) VALUES ('$name','$email','$subject','$content',false)");
	}
	
	mysqli_close($connection);
	
	echo '<br> <a href="submitTicket.php">Go back</a>';
?>