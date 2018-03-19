<?php
session_start();
?>
<nav id="headerNav" class="space-between">
  <div>
    <a href="/CRABZ-PROJ/index.php">Home</a>
    <a href="/CRABZ-PROJ/currencyExchange/CurrencyEx.php">Currency exchange</a>
    <!-- <a href="/CRABZ-PROJ/transfer/viewTransfers.php">Transfer</a> -->
    <a href="/CRABZ-PROJ/importingcsv/csvimport.php">Import</a>
    <a href="/CRABZ-PROJ/views/viewTransactions.php">Transactions</a>
    <a href="/CRABZ-PROJ/account/Account.php">Account</a>
  </div>
  <div>
  <?php if(!isset($_SESSION['userId'])) { ?>
    <a href="/CRABZ-PROJ/login/login.php">Login</a>
    <a href="">Sign up</a>
  <?php } else { ?>
    <a href="/CRABZ-PROJ/login/logout.php">Log out</a>
  <?php } ?>
  </div>
</nav>
