<?php
  /**
  * Builds a SQL statement to query for transactions based on filter settings applied by user
  */
  function filterSQLTransactions($con, $orderBy, $sortBy, $fromDate, $toDate, $minAmount, $maxAmount) {

    //  Starter SQL for all queries
    $SQL = "SELECT dateTime, note, amount, transId FROM transaction WHERE amount >= ? AND amount <= ? AND dateTime >= ? AND dateTime <= ? ";

    //  Append order by clause
    switch ($orderBy) {
      case 'dateTime':
        $SQL = $SQL . "ORDER BY dateTime ";
        break;
      case 'credit':
        //  TODO
        // This needs to be changed to to a transaction type i.e. credit = 0, debit = 1
        $SQL = $SQL . "ORDER BY dateTime ";
        break;
      case 'debit':
        //  TODO
        // This needs to be changed to to a transaction type i.e. credit = 0, debit = 1
        $SQL = $SQL . "ORDER BY dateTime ";
        break;
      case 'amount':
        $SQL = $SQL . "ORDER BY amount ";
        break;
    }

    //  Append ASC/DESC
    switch ($sortBy) {
      case 'Asc':
        $SQL = $SQL . "ASC";
        break;
      case 'Desc':
        $SQL = $SQL . "DESC";
        break;
    }

    // Prepare the statement
    $stmt = $con->prepare($SQL);
    $stmt->bind_param('ddss', $minAmount, $maxAmount, $fromDate, $toDate);

    return $stmt;

  }

  /**
  * Builds the budget SQL query based on user settings
  */
  function budgetSQLTransactions($con, $orderBy, $sortBy, $fromDate, $toDate) {
    //  Starter SQL for all queries
    $SQL = "SELECT dateTime, note, amount, transId FROM transaction WHERE dateTime >= ? AND dateTime <= ? ";

    //  Append order by clause
    switch($orderBy) {
      case 'dateTime':
        $SQL = $SQL . "ORDER BY dateTime ";
        break;
      case 'credit':
        //  TODO
        // This needs to be changed to to a transaction type i.e. credit = 0, debit = 1
        $SQL = $SQL . "ORDER BY dateTime ";
        break;
      case 'debit':
        //  TODO
        // This needs to be changed to to a transaction type i.e. credit = 0, debit = 1
        $SQL = $SQL . "ORDER BY dateTime ";
        break;
      case 'amount':
        $SQL = $SQL . "ORDER BY amount ";
        break;
    }

    //  Append ASC/DESC
    switch($sortBy) {
      case 'Asc':
        $SQL = $SQL . "ASC";
        break;
      case 'Desc':
        $SQL = $SQL . "DESC";
        break;
    }

    // Prepare the statement
    $stmt = $con->prepare($SQL);
    $stmt->bind_param('ss', $fromDate, $toDate);

    return $stmt;
  }

?>
