<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Pay Bills</title>
		<meta charset="utf-8">
		<link href="css/payBills.css" rel="stylesheet">
		<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
		 <link rel="stylesheet" href="../css/reset.css"/>
   		 <link rel="stylesheet" href="../css/layout.css"/>
   		 <link rel="stylesheet" href="../css/nav-header.css">
	</head>
	<body class="bodyWrapper">
	<script>
$(document).ready(function(e){
	$( ":button" ).on("click", function() {
		var all = $("#bill");
		alert(all);
		for(var o =0 ; o<all.length; o++){
			var x = all[i].attr("title");
			alert(x);
			if(all[i].attr("title") !== x){
			   all[i].css("display" , "none")
			   }
		}
		
		
	})
	
	
	
});
		
		</script>
		<header>
      <nav id="headerNav" class="space-between">
        <div>
          <a href="">Home</a>
          <a href="CurrencyEx.html">Currency exchange</a>
          <a href="viewTransfers.php">Transfer</a>
          <a href="viewTransactions.php">Summary</a>
          <a href="Account.php">Account</a>
        </div>
        <div>
          <a href="login.html">Login</a>
          <a href="">Sign up</a>
        </div>
      </nav>
		</header>
		 <div class="mainDivWrapper singleColumn-Margin">
      <main class="mainWrapper">
		
			<div id="billList">
			<h1>Bills</h1>
			Sort By:
			<button type="button" title = "date">Date</button>
			<button type="button" title = "az">A-Z</button>
			<button type="button" title = "za">Z-A</button>
			<button type="button" title = "low">Lowest</button>
			<button type="button" title = "high">Highest</button>
				<table> <tr><th>company name</th><th>amount</th></tr>
				<?php 
				session_start();
				//connect to database and populate their bills
				$connection = mysqli_connect("localhost", "", "", "test");//connect to dylans local database
				//$connection = mysqli_connect("localhost", "crabz", "88yGu2XF", "crabz");//connect to real database
				$queryDate = mysqli_query($connection, "SELECT * FROM bills WHERE userId=1 order by billId desc");//**userId will be changed to who's logged in ID
				//$queryAZ = mysqli_query($connection, "SELECT * FROM bills WHERE userId=1 order by companyName desc");
				//$queryZA = mysqli_query($connection, "SELECT * FROM bills WHERE userId=1 order by companyName asc");
				//$queryLow = mysqli_query($connection, "SELECT * FROM bills WHERE userId=1 order by amount asc");
				//$queryHigh = mysqli_query($connection, "SELECT * FROM bills WHERE userId=1 order by amount desc");
				
				while($row = mysqli_fetch_array($queryDate)){
					//echo '<div class="bill" id="Bill '.$row['billId'].'">';
					echo '<tr><td>'.$row['companyName'].'</td>';
					echo '<td>'.$row['amount'].'';
					echo '<button type="button" style="float:right;" onclick="selectBill(\'Bill '.$row['billId'].'\')">Select bill</button></td></tr>';
					//echo '</div>';
				}
				mysqli_close($connection);
				?>
				</table>
			</div>
		  
    
			<div id="selectPaymentMethod">
				<h1>Select Payment Method</h1>
				
				<form action="payBillsProcess.php" method="POST">
				Select account:
				  <select name="selectedAccount">
					<?php 
						//connect to database and populate their bills
						$connection = mysqli_connect("localhost", "", "", "test");//connect to dylans local database
						//$connection = mysqli_connect("localhost", "crabz", "88yGu2XF", "crabz");//connect to real database
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