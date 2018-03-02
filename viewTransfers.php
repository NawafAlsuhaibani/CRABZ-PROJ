<?php
  session_start();
  include('db_credentials.php');
  include('getTransfers.php');
  $_SESSION['userId'] = 1;  //  Arbitary value **Assign upon loginPage
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/reset.css"/>
    <link rel="stylesheet" href="css/layout.css"/>
    <link rel="stylesheet" href="css/nav-header.css"/>
    <link rel="stylesheet" href="css/transfers.css"/>
    <script type='text/javascript' src="script/jquery-3.1.1.min.js"></script>
    <script type='text/javascript' src="script/viewTransfers.js"></script>
    <title>CRABZ-View Account Information</title>
  </head>
  <body class="bodyWrapper">
    <header>
      <nav id="headerNav" class="space-between">
        <div>
          <a href="">Home</a>
          <a href="CurrencyEx.html">Currency exchange</a>
          <a href="viewTransfers.php">Transfer</a>
          <a href="viewTransactions.php">Summary</a>
          <a href="Account.php">Account</a>
        </div>
        <div>
          <a href="login.html">Login</a>
          <a href="">Sign up</a>
        </div>
      </nav>
    </header>
    <div class="mainDivWrapper singleColumn-Margin">
      <main class="mainWrapper">
        <section class="flex-row space-between small-pad bg-color-dark"> <!-- Header bar -->
         <div>
           <h1 class="text-color-light">Transfers Overview</h1>
           <form method="post" action="transfers.php">
             <div>
               <input type="radio" name="sort" value="Successful" checked="checked"/><label>Successful</label>
               <input type="radio" name="sort" value="Pending"/><label>Pending</label>
               <input type="radio" name="sort" value="Failed"/><label>Failed</label>
             </div>
             <div>
               <input type="radio" name="filter" value="Sent" checked="checked"/><label>Sent</label>
               <input type="radio" name="filter" value="Received"/><label>Received</label>
               <input type="submit"/>
             </div>
           </form>
         </div>
         <h2 id="transferType">dummy text</h2>
         <div>
          <h3 class="text-color-light">Total: </h3><label>?</label>
        </div>
        </section> <!-- Header ends -->
        <section class="flex-col small-pad margin-top bg-color-dark"> <!-- Container for transfers -->
          <article class="entry space-between">
            <table>
              <tr>
                <th>Status</th><th>Amount</th><th id="sender-receiver">Sender/Reciever</th></th><th>Account</th><th>Date</th>
              </tr>
              <?php
              //  Get DB connection
              $con = connect();
              ?>
              <tr>
                <td>Successful</td><td>Some Amount</td><td>Sender/Receiver</td><td>Account sent from or received to</td><td>the date</td>
              </tr>
            </table>
          </article>
        </section> <!-- Container for transfers ends -->
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
