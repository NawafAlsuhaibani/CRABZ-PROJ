<?php

  //  Start the session
  session_start();

  require('../db_credentials.php');

  //  Get DB con
  $con = connect();

  //  Starter sql for all queries
  $sql = "SELECT dateTime, note, amount, transId FROM transaction, account WHERE fromAcc = accNum AND fromAcc = ? AND ownerId = ? ";

  $params = 2; // Track amount of params to bind

  //  SQL builder
  switch($_POST['filterMethod']){
    case 'budget':
      $sql = $sql . "AND dateTime >= ? AND dateTime <= ? ";
      $params = 4;
      break;
    case 'transaction':
      $sql = $sql . "AND dateTime >= ? AND dateTime <= ? AND amount >= ? AND amount <= ? ";
      $params = 6;
      break;
  }

  //  Append order by clause
  switch ($_POST['sortBy']) {
    case 'dateTime':
      $sql = $sql . "ORDER BY dateTime ";
      break;
    case 'credit':
      //  TODO
      // This needs to be changed to to a transaction type i.e. credit = 0, debit = 1
      $sql = $sql . "ORDER BY dateTime ";
      break;
    case 'debit':
      //  TODO
      // This needs to be changed to to a transaction type i.e. credit = 0, debit = 1
      $sql = $sql . "ORDER BY dateTime ";
      break;
    case 'amount':
      $sql = $sql . "ORDER BY amount ";
      break;
  }

  //  Append ASC/DESC
  switch ($_POST['orderBy']) {
    case 'Asc':
      $sql = $sql . "ASC";
      break;
    case 'Desc':
      $sql = $sql . "DESC";
      break;
  }

  //  Assemble stmt
  $stmt = $con->prepare($sql);

  //  Bind params
  switch($params) {
    case 2: //  Basic case no filter
      $stmt = bind_parm('dd', $_POST['accNum'], $_SESSION['userId']);
      break;
    case 4:
      if($_POST['bindMethod'] == 'date')
        $stmt->bind_param('ddss', $_POST['accNum'], $_SESSION['userId'], $_POST['datefrom'], $_POST['dateto']);
      else
        $stmt->bind_param('dddd', $_POST['accNum'], $_SESSION['userId'], $_POST['amtlower'], $_POST['amtupper']);
      break;
    case 6:
      if($_POST['bindMethod'] == 'date')
        $stmt->bind_param('ddssdd', $_POST['accNum'], $_SESSION['userId'], $_POST['datefrom'], $_POST['dateto'], $_POST['amtlower'], $_POST['amtupper']);
      else
        $stmt->bind_param('ddddss', $_POST['accNum'], $_SESSION['userId'], $_POST['amtlower'], $_POST['amtupper'], $_POST['datefrom'], $_POST['dateto']);
      break;
  }

  // Execute and print
  $stmt->execute();
  $stmt->bind_result($date,$note,$amount,$tId);
  //  Loop through rows of result_set and print
  $remainder; //  **TODO**  Update DB code here to get a balance from transaction
  while($stmt->fetch()) {
    $remainder = $_POST['balance'] - $amount;
    echo "<tr><td>Type</td><td>$amount</td><td>$tId</td><td>$note</td><td>$remainder</td><td>$date</td></tr>";
  }

  $stmt->close();
  $con->close();

?>
