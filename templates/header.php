<?php
session_start();
?>
<nav id="headerNav" class="space-between">
  <div>
    <a href="../views/index.php">Home</a>
    <a href="../views/viewCurrency.php">Currency Conversion</a>
    <!-- <a href="/CRABZ-PROJ/transfer/viewTransfers.php">Transfer</a> -->
    <a href="../importingcsv/csvimport.php">Import</a>
    <a href="../views/viewTransactions.php">Advanced View</a>
    <a href="../views/viewAccount.php">Account</a>
  </div>
  <div>
  <?php if(!isset($_SESSION['userId'])) { ?>
    <a href="../views/viewLogin.php">Login</a>
    <a href="../views/register.html">Sign Up</a>
  <?php } else { ?>
    <a href="../lib/login/logout.php">Logout</a>
  <?php } ?>
  </div>
</nav>
