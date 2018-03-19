<?php
session_start();
?>
<nav id="headerNav" class="space-between">
  <div>
    <a href="/CRABZ-PROJ/index.html">Home</a>
    <a href="/CRABZ-PROJ/currencyExchange/CurrencyEx.html">Currency exchange</a>
    <!-- <a href="/CRABZ-PROJ/transfer/viewTransfers.php">Transfer</a> -->
    <a href="/CRABZ-PROJ/transactions/viewTransactions.html">Transactions</a>
    <a href="/CRABZ-PROJ/account/Account.php">Account</a>
  </div>
  <div>
  <?php if(!isset($_SESSION['userId'])) { ?>
    <a href="/CRABZ-PROJ/login/login.html">Login</a>
    <a href="">Sign up</a>
  <?php } else { ?>
    <a href="/CRABZ-PROJ/login/logout.php">Log out</a>
  <?php } ?>
  </div>
</nav>
