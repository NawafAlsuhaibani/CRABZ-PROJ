<?php
  /**
  * Builds a sql statement to query for transactions based on filter settings applied by user
  */
  function filtersqlTransactions($con, $orderBy, $sortBy, $fromDate, $toDate, $minAmount, $maxAmount) {

    //  Starter sql for all queries
    $sql = "SELECT dateTime, note, amount, transId FROM transaction WHERE amount >= ? AND amount <= ? AND dateTime >= ? AND dateTime <= ? ";

    //  Append order by clause
    switch ($orderBy) {
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
    switch ($sortBy) {
      case 'Asc':
        $sql = $sql . "ASC";
        break;
      case 'Desc':
        $sql = $sql . "DESC";
        break;
    }

    // Prepare the statement
    $stmt = $con->prepare($sql);
    $stmt->bind_param('ddss', $minAmount, $maxAmount, $fromDate, $toDate);
    return $stmt;

  }

  /**
  * Builds the budget sql query based on user settings
  */
  function budgetsqlTransactions($con, $orderBy, $sortBy, $fromDate, $toDate) {
    //  Starter sql for all queries
    $sql = "SELECT dateTime, note, amount, transId FROM transaction WHERE dateTime >= ? AND dateTime <= ? ";

    //  Append order by clause
    switch($orderBy) {
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
    switch($sortBy) {
      case 'Asc':
        $sql = $sql . "ASC";
        break;
      case 'Desc':
        $sql = $sql . "DESC";
        break;
    }

    // Prepare the statement
    $stmt = $con->prepare($sql);
    $stmt->bind_param('ss', $fromDate, $toDate);
    return $stmt;
  }

?>
