<?php

session_start();

require('../db_credentials.php');

$con = connect();

$sql = "SELECT SUM(amountCost) FROM cvsfileimport WHERE accountnum = ? AND dateNtime >= ? AND dateNtime <= ?";

$category = $_POST['category'] . "%";

switch($_POST['category']){

case "All":
	$stmt = $con->prepare($sql);

	$stmt->bind_param('iss', $_POST['accNum'], $_POST['datefrom'], $_POST['dateto']);
	$stmt->execute();
	$stmt->bind_result($total);
	$stmt->fetch();

	echo $total;

	$stmt->close();
	$con->close();

break;
	default:
	$sql = $sql . " AND paytype like ?";

	$stmt = $con->prepare($sql);

	$stmt->bind_param('isss', $_POST['accNum'], $_POST['datefrom'], $_POST['dateto'], $category);
	$stmt->execute();
	$stmt->bind_result($total);
	$stmt->fetch();

	echo $total;

	$stmt->close();
	$con->close();
break;
}


?>
