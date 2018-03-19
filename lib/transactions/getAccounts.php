<?php

  session_start();

  require("../db_credentials.php");

  if(isset($_SESSION['userId'])) {
    $sql = "SELECT * FROM account WHERE ownerId = ?";
    $con = connect();
    $stmt = $con->prepare($sql);
    $stmt->bind_param('d',$_SESSION['userId']);
    $stmt->execute();
    $stmt->bind_result($accNum, $balance, $accType, $ownerId, $instNum);
  //  $list = array();
    while($stmt->fetch()) {
      echo "<option value=" . $accNum . ">" . $accType . " $" . $balance . "</option>";
    //array_push('value' => $accNum, 'text' => $accType . ' $' . $balance);
    }
    $stmt->free_results();
    $stmt->close();
    $con->close();

    //echo json_encode($list);
  }

?>
