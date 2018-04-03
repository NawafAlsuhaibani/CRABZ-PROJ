<?php

session_start();

require('../db_credentials.php');

$con = connect();

$sql = "SELECT SUM(amountCost) FROM cvsfileimport WHERE userid = ? AND dateNtime >= ? AND dateNtime <= ?";

$stmt = $con->prepare($sql);
$stmt->bind_param('iss', $_SESSION['userId'], $_POST['datefrom'], $_POST['dateto']);
$stmt->execute();
$stmt->bind_result($total);
$stmt->fetch();

echo $total;

$stmt->close();
$con->close();

?>
