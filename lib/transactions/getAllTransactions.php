<?php

  session_start();

  require('/CRABZ-PROJ/lib/db_credentials.php');

  if(isset($_POST['accNum']) && isset($_POST['balance'])) {
    $con = connect();
    $sql = "SELECT dateTime, note, amount, transId, fromAcc FROM transaction WHERE fromAcc = ? ORDER BY dateTime Desc";
    $stmt = $con->prepare($sql);
    $stmt->bind_param('d',$_POST['accNum']);
    $stmt->execute();

    $stmt->bind_result($date,$note,$amount,$tId, $fromAcc);
    //  Loop through rows of result_set and print
    $remainder;
    while($stmt->fetch()) {
      $remainder = $_POST['balance'] - $amount;
      echo "<tr><td>Type</td><td>$amount</td><td>$tId</td><td>$note</td><td>$remainder</td><td>$date</td></tr>";
    }

    $stmt->close();
    $con->close();

  }

?>
