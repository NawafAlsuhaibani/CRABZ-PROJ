<?php
  /**
  * Builds an SQL query based on status
  */
  function getTransfersByStatus($con, $status, $userId) {

    $sql = "SELECT DISTINCT tId, status, amount, fromAcc, toAcc, note, date FROM transfer, account WHERE ownerId = ?";

    $sql = $sql . " AND status = ?";

    $stmt = $con->prepare($sql);

    $stmt->bind_param('dd', $userId, $status);

    return $stmt;

  }

  /**
  * Builds an SQL query based on sent/received
  */
  function getTransfersByType($con, $to_from, $userId) {

    $sql = "SELECT DISTINCT tId, status, amount, fromAcc, toAcc, note, date FROM transfer, account WHERE ownerId = ?";

    switch($to_from) {
      case 'Sent':
        $sql = $sql . " AND fromAcc = accNum";
        break;
      case 'Received':
        $sql = $sql . " AND toAcc = accNum";
        break;
    }

    $stmt = $con->prepare($sql);

    $stmt->bind_param('d', $userId);

    return $stmt;

  }

  /**
  * Builds an SQL query based on status and type
  */
  function getTransfersFiltered($con, $status, $to_from, $userId) {

    $sql = "SELECT DISTINCT tId, status, amount, fromAcc, toAcc, note, date FROM transfer, account WHERE ownerId = ?";

    $sql = $sql . " AND status = ?";

    switch($to_from) {
      case 'Sent':
        $sql = $sql . " AND fromAcc = accNum";
        break;
      case 'Received':
        $sql = $sql . " AND toAcc = accNum";
        break;
    }

    $stmt = $con->prepare($sql);

    $stmt->bind_param('dd', $userId, $status);

    return $stmt;

  }

  /**
  * Builds an SQL query that retrieves all transfers of all types
  */
  function getTransfersAll($con, $userId) {

    $sql = "SELECT DISTINCT tId, status, amount, fromAcc, toAcc, note, date FROM transfer, account WHERE (fromAcc = accNum OR toAcc = accNum) AND ownerId = ?";

    $stmt = $con->prepare($sql);

    $stmt->bind_param('d', $userId);

    return $stmt;

  }

  /**
  * Return the string representation of accType
  */
  function getAccType($accType) {
    if($accType == 0)
      return 'Chequing';
    else
      return 'Savings';
  }

  /**
  * Return the string representation of transferType
  */
  function getTransType($transType) {
    if($transType == 0)
      return 'Pending';
    else if ($transType == 1)
      return 'Successful';
    else
      return 'Failed';
  }

  function isClaimable($toAcc, $userId) {
    $con = mysqli_connect("localhost","crabz","88yGu2XF","crabz");

    $sql = "SELECT accNum FROM account WHERE ownerId = ? AND accNum = ?";

    $stmt = $con->prepare($sql);

    $stmt->bind_param('dd', $_SESSION['userId'], $toAcc);

    $stmt->execute();

    $stmt->bind_result($accNum);

    $stmt->fetch();


      if($accNum === $toAcc) {
        $stmt->close();

        return true;
      }
      else {
        $stmt->close();

        return false;
    }

  }

  /**
  * Query for user account types
  */
  function getAccounts($con, $userId) {
    $sql = "SELECT accType, balance, accNum FROM account WHERE ownerId = ?";

    $stmt = $con->prepare($sql);

    $stmt->bind_param('d', $_SESSION['userId']);

    $stmt->execute();

    return $stmt;
  }


?>
