<?php
  session_start();
  include('../lib/db_credentials.php');
  include('../lib/getTransfers.php');
  $_SESSION['userId'] = 1;  //  Arbitary value **Assign upon loginPage
  $con = connect();
  //  Redirected to this page so process request first
  if(!$_SESSION['sentTransfer']) {
    $sql = "INSERT INTO transfer (status, amount, fromAcc, toAcc, date, note) VALUES (?,?,?,?,?,?)";
    $stmt = $con->prepare($sql);
    $status = 0;
    $date = date('Y-m-d');
    $stmt->bind_param('idiiss', $status, $_POST['amount'], $_POST['accounts'], $_POST['sendTo'], $date, $_POST['note']);
    $stmt->execute();
    $stmt->fetch();
    $stmt->close();
  }

  // Check to see if added to DB
  $sql = "SELECT * FROM transfer WHERE status = ? AND amount = ? AND fromAcc = ? AND toAcc = ? AND date =? AND note = ?";
  $stmt = $con->prepare($sql);
  $status = 0;
  $date = date('Y-m-d');
  $stmt->bind_param('idiiss', $status, $_POST['amount'], $_POST['sendTo'], $_POST['accounts'], $date, $_POST['note']);
  $stmt->execute();
  $stmt->fetch();
  $stmt->close();
  if($stmt && !$_SESSION['sentTransfer']) {
    $transfer = true;
    $_SESSION['sentTransfer'] = true;
    $sql = "UPDATE account SET balance = balance - ? WHERE accNum = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param('di', $_POST['amount'], $_POST['accounts']);
    $stmt->execute();
    $stmt->fetch();
    $stmt->close();
  }
  else
    $transfer = false;

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/reset.css"/>
    <link rel="stylesheet" href="../css/layout.css"/>
    <link rel="stylesheet" href="../css/nav-header.css">
    <script type='text/javascript' src="../script/jquery-3.1.1.min.js"></script>
    <script type='text/javascript' src="../script/viewTransfers.js"></script>
    <title>CRABZ-View Account Information</title>
  </head>
  <body class="bodyWrapper">
    <header>
      <nav id="headerNav" class="space-between">
        <div>
          <a href="">Home</a>
          <a href="../currencyExchange/CurrencyEx.html">Currency exchange</a>
          <a href="viewTransfers.php">Transfer</a>
          <a href="../Transactions/viewTransactions.php">Summary</a>
          <a href="../Account/Account.php">Account</a>
        </div>
        <div>
          <a href="../login/login.html">Login</a>
          <a href="">Sign up</a>
        </div>
      </nav>
    </header>
    <div class="mainDivWrapper singleColumn-Margin">
      <main class="mainWrapper">
        <div class="flex-col">
          <?php
          if($transfer) {echo '<h1>Transfer was successful</h1>';}
          else {echo '<h1>Transfer was unsuccessful</h1>';}
          ?>
          <a href="viewTransfers.php">Go Back</a>
        </div>
      </main>
      <!--
      <nav class="rightColumn">
      </nav>
      <aside class="leftColumn">
      </aside>
      -->
    </div>
    <footer>
    </footer>
  </body>
</html>
