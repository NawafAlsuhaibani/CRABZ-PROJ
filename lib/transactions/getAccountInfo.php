<?php

  session_start();

  require('../db_credentials.php');

  if(isset($_POST['accNum'])) {
    $sql = "SELECT accNum, balance, accType, instNum, ownerId FROM account WHERE ownerId = ? AND accNum = ?";
    $con = connect();
    $stmt = $con->prepare($sql);
    $stmt->bind_param('dd', $_SESSION['userId'], $_POST['accNum']);
    $stmt->execute();
    $stmt->bind_result($accNum, $balance, $accType, $instNum, $ownerId);
    $stmt->fetch();

    $str = "";

    //$bus = array(
      //'accNum' => $accNum,
      //'balance' => $balance,
      //'accType' => $accType,
      //'instNum' => $instNum
    //);

    //array_push($json, $bus);

    $str = "$accNum, $balance, $accType, $instNum";

    echo $str;

    $stmt->close();
    $con->close();
  }

?>
