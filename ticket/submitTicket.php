<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Submit a Ticket</title>
		<meta charset="utf-8">
	</head>
	<body>
	
		<h1 style="display:inline; font-size:44px;"><strong>Submit a Ticket</strong></h1>
		
		<form action="submitTicketProcess.php" method="POST" onsubmit="return validateForm(1)">
			Name (optional)
			<input type="text" id="name" name="name" value=""> 
			<br>
			Email (optional)
			<input type="email" id="email" name="email" value=""> 
			<br>
			Subject (required)
			<input type="text" id="subject1" name="subject" value=""> 
			<br><br>
			Enter your ticket below (250 character limit)
			<br>
			<textarea rows="4" cols="50" id="userFeedback" name="commentArea" maxlength="250"></textarea>
			<input type="hidden" value="true" name="isTicket"><!-- hidden isTicket "fake boolean its just a string" is sent to php page making this ticket a ticket in the database-->
			<br>
			<button type="submit">Submit</button>
			<button type="reset">Reset</button>
		</form>
		
		<hr>
		
		<h1 style="display:inline; font-size:44px;"><strong>Submit Feedback</strong></h1>
		
		<form action="submitTicketProcess.php" method="POST" onsubmit="return validateForm(2)">
			Name (optional)
			<input type="text" id="name" name="name" value=""> 
			<br>
			Email (optional)
			<input type="email" id="email" name="email" value=""> 
			<br>
			Subject (required)
			<input type="text" id="subject2" name="subject" value=""> 
			<br><br>
			Insert suggestions, comments about our site, or feedback below (250 character limit)
			<br>
			<textarea rows="4" cols="50" id="userFeedback" name="commentArea" maxlength="250"></textarea>
			<input type="hidden" value="false" name="isTicket">
			<br>
			<button type="submit">Submit</button>
			<button type="reset">Reset</button>
		</form>
		
		<footer>
		Copyright © 2018
		</footer>
		<script>
			function validateForm(form){
				if (form == 1){
					if(document.getElementById("subject1").value == ""){
						window.alert("Please enter a subject for the ticket forum");
						return false;	
					}
				}
				else{
					if(document.getElementById("subject2").value == ""){
						window.alert("Please enter a subject for the feedback forum");
						return false;	
					}
				}
					
			}
		</script>
	</body>
</html>