<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Pay Bills</title>
		<meta charset="utf-8">
		<link href="css/payBills.css" rel="stylesheet">
	</head>
	<body>
		<header>
			<h1 style="display:inline; font-size:44px;"><strong>PAY BILLS</strong></h1>
			<a href="#">Home</a> |
			<a href="#">My Accounts</a> |
			<a href="#">Logout</a> |
		</header>
		
			<div id="billList">
			<h1>Bills</h1>
			Sort By:
			<button type="button" onclick="alert('Hello world!')">Date</button>
			<button type="button" >A-Z</button>
			<button type="button" >Z-A</button>
			<button type="button" >Lowest</button>
			<button type="button" >Highest</button>
				
				<?php 
				session_start();
				//connect to database and populate their bills
				//$connection = mysqli_connect("localhost", "webuser", "", "crabzfake");//connect to dylans local database
				$connection = mysqli_connect("localhost", "crabz", "88yGu2XF", "crabz");//connect to real database
				$query = mysqli_query($connection, "SELECT * FROM bills WHERE userId=1");//**userId will be changed to who's logged in ID
				
				while($row = mysqli_fetch_array($query)){
					echo '<div class="bill" id="Bill '.$row['billId'].'">';
					echo '<h6>'.$row['companyName'].'</h6>';
					echo 'Amount: '.$row['amount'].'';
					echo '<button type="button" style="float:right;" onclick="selectBill(\'Bill '.$row['billId'].'\')">Select bill</button>';
					echo '</div>';
				}
				mysqli_close($connection);
				?>
				
			</div>
			
			<div id="selectPaymentMethod">
				<h1>Select Payment Method</h1>
				
				<form action="payBillsProcess.php" method="POST">
				Select account:
				  <select name="selectedAccount">
					<?php 
						//connect to database and populate their bills
						//$connection = mysqli_connect("localhost", "webuser", "", "crabzfake");//connect to dylans local database
						$connection = mysqli_connect("localhost", "crabz", "88yGu2XF", "crabz");//connect to real database
						$query = mysqli_query($connection, "SELECT * FROM account WHERE ownerId=1");//**ownerId will be changed to who's logged in ID
						
						while($row = mysqli_fetch_array($query)){
							echo '<option>'.$row['accNum'].'</option>';
						}
						mysqli_close($connection);
					?>	
				  </select>
				  <br>
				  Enter $ Amount:
				  <input type="text" id="amount" name ="selectedAmount" value="">
				  <br>
				  <button type="submit">Submit</button>
				  <button type="reset">Reset</button>
				 <input type="hidden" value="" name="billId" id="updateBillId"><!-- hidden billId being transfered-->
				</form>
					
			</div>		
		
		<footer>
		Copyright © 2018
		</footer>
		<script>
			function selectBill(billID){
				selectedBill = billID;
				window.alert(billID + " selected");
				document.getElementById('updateBillId').value = billID;//when user hits button we update the bill ID in the forum
				selectedbill = document.getElementById(billID).style.color = 'red';
			}
		</script>
	</body>
</html>