<?php

  session_start();

  require('../db_credentials.php');

//  if(isset($_POST['accNum']) && isset($_POST['balance'])) {
    $con = connect();
    $sql = "SELECT dateNtime, amountCost, paytype, accountnum, csvid FROM cvsfileimport WHERE accountnum = ? ORDER BY dateNtime Desc";
    if(isset($_POST['limit'])){
      switch($_POST['limit']) {
        case '25':
          $sql = $sql . " LIMIT 25";
          break;
        case '50':
          $sql = $sql . " LIMIT 50";
          break;
        case '100':
          $sql = $sql . " LIMIT 100";
          break;
        case 'all':
          $sql = $sql;
          break;
      }
    }
    $stmt = $con->prepare($sql);
    $stmt->bind_param('i',$_POST['accNum']);
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
