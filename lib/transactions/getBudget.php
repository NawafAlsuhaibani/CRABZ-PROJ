<?php

session_start();

require('/CRABZ-PROJ/lib/db_credentials.php');

$con = connect();

$sql = "SELECT SUM(amount) FROM transaction WHERE fromAcc = ? AND dateTime >= ? AND dateTime <= ?";

$stmt = $con->prepare($sql);
$stmt->bind_param('dss', $_POST['accNum'], $_POST['datefrom'], $_POST['dateto']);
$stmt->execute();
$stmt->bind_result($total);
$stmt->fetch();

echo $total;

$stmt->close();
$con->close();

?>
