<?php
	
	$billId = $_POST["billId"];
	$billId = substr($billId,5,1);// substring from "Bill X" to just "X"
	$billId = intval($billId);//converting "X" to numerical X
	$selectedAmount = $_POST["selectedAmount"];
	$selectedAccount = $_POST["selectedAccount"];
	
		//connect to database to pay the bill
		$connection = mysqli_connect("localhost", "", "", "test");//connect to dylans local database
		//$connection = mysqli_connect("localhost", "crabz", "88yGu2XF", "crabz");//connect to real database
		
		//get account balance and see if user has enought funds to pay the bill
		$query = mysqli_query($connection, "SELECT balance FROM account WHERE accNum = " . $selectedAccount);
		$query2 = mysqli_query($connection, "SELECT amount FROM bills WHERE billId = " . $billId);
		
		$check = mysqli_fetch_array($query);
		$balance = $check['balance'];
		$check2 = mysqli_fetch_array($query2);
		$amount = $check2['amount'];
		
		if($balance < $amount){
			echo 'Insufficient funds in account';
		}
		else{
			//subtract amount from user account
			$query3 = mysqli_query($connection, "UPDATE account SET balance = balance - " . $selectedAmount . " WHERE accNum = " . $selectedAccount);
			//subtract amount from user Bill
			$query4 = mysqli_query($connection, "UPDATE bills SET amount = amount - " . $selectedAmount . " WHERE billId = " . $billId);
			//add funds to payee account
			echo 'Bill paid!';
			echo '<br> <a href="payBills.php">Go back</a>';
		}
		
		mysqli_close($connection);
?>	

