<?php

  session_start();

  require('../db_credentials.php');

//  if(isset($_POST['accNum']) && isset($_POST['balance'])) {
    $con = connect();
    $sql = "SELECT dateNtime, amountCost, paytype, userid, csvid FROM cvsfileimport WHERE userid = ? ORDER BY dateNtime Desc";
    $stmt = $con->prepare($sql);
    $stmt->bind_param('i',$_SESSION['userId']);
    $stmt->execute();

    $stmt->bind_result($date,$amount,$paytype,$userid, $csvid);
    //  Loop through rows of result_set and print
    $remainder;
    while($stmt->fetch()) {
      //$remainder = $_POST['balance'] - $amount;
      echo "<tr><td>$date</td><td>$amount</td><td>$paytype</td></tr>";
    }

    $stmt->close();
    $con->close();

//  }

?>
