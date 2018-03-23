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
    <script type='text/javascript' src="../script/viewTransactions.js"></script>
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
              <button id="showBudget">Budget</button>
              <button id="showTransactions">Transactions</button>
            </div>
          </section>
            <!-- Transaction view shown by default or when the user hits 'Transactions' button -->
            <section id="TransactionView" class="flex-row space-between small-pad margin-top bg-color-dark">
              <h2 class="inline-block">Transaction History</h2>
              <form id="transactionsForm" method="get" action="viewTransactions.php"/>
                <section class="flex-row space-between">
                  <div class="flex-col space-between small-margin-sides">
                    <h3>Sort Options</h3>
                    <div class="flex-col">
                      <select name="sortBy">
                        <option value="dateTime">Date</option>
                        <option value="type">Type</option>
                        <option value="amount">Amount</option>
                      </select>
                      <select name="orderBy">
                        <option value="Desc">Desc</option>
                        <option value="Asc">Asc</option>
                      </select>
                    </div>
                  </div>
                  <div class="flex-col small-margin-sides">
                    <div class="flex-row">
                      <h3 class="inline-block">Filter Options</h3>
                      <button>Filter</button>
                    </div>
                    <div class="flex-row">
                      <div class="flex-col space-between">
                        <label>From:</label>
                        <label>To:</label>
                      </div>
                      <div class="flex-col space-between">
                        <input name="fromDate" type="date" required></input>
                        <input name="toDate" type="date" required></input>
                      </div>
                    </div>
                  </div>
                  <section class="flex-row small-margin-sides">
                    <div class="flex-col space-between">
                      <p>Minimum Amount:</p>
                      <p>Maximum Amount:</p>
                    </div>
                    <div class="flex-col space-between">
                      <input type="number" class="block smallField" name="minAmt" required/>
                      <input type="number" class="block smallField" name="maxAmt" required/>
                    </div>
                  </section>
                </section>
              </form>
            </section>
            <!-- Budget page to be displayed when user: Hits 'Budget' button handled through JS or
                  by checking if the budget form has been submitted -->
            <section id="BudgetView" class="flex-row space-between small-pad margin-top bg-color-dark hidden">
              <h2 class="inline-block">Budget Summary</h2>
              <form id="budgetForm" method="post" action="viewTransactions.php">
                <div class="flex-row">
                  <div class="flex-col space-between small-margin-sides">
                    <h3 class="inline-block">Budget Settings</h3>
                    <button id="setBudget">Set Budget</button>
                  </div>
                  <div name="Sort-Options" class="inline-block box">
                    <h3>Sort Options</h3>
                    <div class="inline-block">
                      <select name="sortByB">
                        <option value="dateTime">Date</option>
                        <option value="type">Type</option>
                        <option value="amount">Amount</option>
                      </select>
                      <select name="orderByB">
                        <option value="Desc">Desc</option>
                        <option value="Asc">Asc</option>
                      </select>
                    </div>
                  </div>
                  <div class="flex-row small-margin-sides">
                    <div class="flex-col space-between">
                      <label>From:</label>
                      <label>To:</label>
                      <label>Budget Amount:</label>
                    </div>
                    <div class="flex-col space-between">
                      <input name="fromDateB" type="date" required/>
                      <input name="toDateB" type="date" required/>
                      <input name="budgetAmt" type="Number" class="smallField" required/>
                    </div>
                  </div>
                  <div class="flex-row small-margin-sides">
                    <div class="flex-col space-between text-center">
                      <p>Spent:</p>
                      <p>Budget left:</p>
                      <p>You are:</p>
                    </div>
                    <div class="flex-col space-between">
                      <p id="budgetSpent"></p>
                      <p id="budgetLeft"></p>
                      <p id="budgetStatus"></p>
                    </div>
                  </div>
                </div>
              </form>
            </section>
          <!-- Table begins here to display transactions -->
          <section class="flex-col small-pad margin-top bg-color-dark">
            <article class="entry space-between">
              <table id="transactionTable">
              </table>
            </article>
          </section>  <!-- End of entry -->
        </main>
        <!--
        <nav class="HolyGrail-nav">
        </nav>
        <aside class="HolyGrail-ads">
        </aside>
      -->
    </div>
    <footer id="footer">
    </footer>
  </body>
</html>
