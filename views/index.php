<?php
  session_start();
  if(!isset($_SESSION['userId']))
    header('location: ../views/viewLogin.php');
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/reset.css"/>
    <link rel="stylesheet" href="../css/layout.css"/>
    <link rel="stylesheet" href="../css/nav-header.css">
    <script type='text/javascript' src="../script/jquery-3.1.1.min.js"></script>
    <script type='text/javascript' src="../script/template.js"></script>
    <script type='text/javascript' src="../script/index.js"></script>
    <title>CRABZ-View Account Information</title>
  </head>
  <body class="bodyWrapper">
    <header id="header">
    </header>
    <div class="mainDivWrapper singleColumn-Margin">
      <main class="mainWrapper">
        <section class="flex-row space-between small-pad bg-color-dark">
          <div>
            <h1>Account Summary</h1>
            <label>Balance:&nbsp</label>
            <label id="balance"></label>
          </div>
          <div class="flex-col">
            <select id="accounts">
            </select>
            <br><br><label>Show</label>
            <select id="limit">
              <option value="25">25</option>
              <option value="50">50</option>
              <option value="100">100</option>
              <option value="all">All</option>
            </select>
          </div>
          <div class="flex-col">
            <div class="flex-row">
              <div class="flex-col">
                <p>Account Type:</p>
                <p>Account Number:</p>
              </div>
              <div class="flex-col">
                <p id="accType"></p>
                <p id="accNum"></p>
              </div>
            </div>
          </div>
        </section>
        <section class="flex-col small-pad margin-top bg-color-dark">
          <article class="entry space-between">
            <table id="transactionTable">
            </table>
          </article>
        </section>  <!-- End of entry -->
      </main>
      <!--
      <nav class="rightColumn">
      </nav>
      <aside class="leftColumn">
      </aside>
      -->
    </div>
    <footer id="footer">
    </footer>
  </body>
</html>
