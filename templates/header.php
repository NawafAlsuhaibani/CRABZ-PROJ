<?php
session_start();
?>
<nav id="headerNav" class="space-between">
  <div>
    <a href="../views/index.php">Home</a>
    <a href="../views/viewCurrency.php">Currency exchange</a>
    <!-- <a href="/CRABZ-PROJ/transfer/viewTransfers.php">Transfer</a> -->
    <a href="../importingcsv/csvimport.php">Import</a>
    <a href="../views/viewTransactions.php">Transactions</a>
    <a href="../Account/Account.php">Account</a>
  </div>
  <div>
  <?php if(!isset($_SESSION['userId'])) { ?>
    <a href="../views/viewLogin.php">Log in</a>
    <a href="../views/register.html">Sign up</a>
  <?php } else { ?>
    <a href="../lib/login/logout.php">Log out</a>
  <?php } ?>
  </div>
</nav>
