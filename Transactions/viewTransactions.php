<?php /* PHP page variables start here */
  session_start();
  include('../lib/db_credentials.php');
  include('../lib/getTransfers.php');
  $_SESSION['userId'] = 1;  //  Arbitary value **Assign upon loginPage
  $setBudget = false;
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/reset.css"/>
    <link rel="stylesheet" href="../css/layout.css"/>
    <link rel="stylesheet" href="../css/nav-header.css">
    <script type='text/javascript' src="../script/jquery-3.1.1.min.js"></script>
    <script type='text/javascript' src="../script/transfers.js"></script>
    <title>CRABZ-View Account Information</title>
  </head>
  <body class="bodyWrapper">
    <header>
      <nav id="headerNav" class="space-between">
        <div>
          <a href="">Home</a>
          <a href="../currency exchnage page/CurrencyEx.html">Currency exchange</a>
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
          <?php /*  PHP to get account information  **change this to get redirected data from accountOveriew page */
            //  Get DB connection
            $con = connect();
            //  Prepare SQL
            $sql = "SELECT * FROM account WHERE ownerId =" . $_SESSION['userId'];
            //  Execute query
            $rst = $con->query($sql);
            // Seek to beginning of results
            $rst->data_seek(0);
            //  Get page variables
            $row = $rst->fetch_assoc();
            $accBalance = $row['balance'];
            $accType = $row['accType'];
            $accNum = $row['accNum'];
            if($accType == 0)
              $accType = "Chequing";
            else
              $accType = "Savings";
            //  Grab budget info to display if budget has been set
            if(isset($_GET['budgetAmt'])) {
              $setBudget = true;
              //  Get variables from form
              $budget = $_GET['budgetAmt'];
              //  Get DB connection
              $con = connect();
              //  Prepare SQL
              $sql = "SELECT SUM(amount) AS total FROM transaction WHERE dateTime >= ? AND dateTime <= ?";
              //  Prepare SQL statement
              $stmt = $con->prepare($sql);
              //  Store variables for binding **Not sure if $_GET works in binding
              $stmt->bind_param('ss', $_GET["fromDate"],$_GET['toDate']);
              $stmt->execute();
              $stmt->bind_result($total);
              $stmt->fetch();
              $stmt->close();
            }
            mysqli_close($con);
           ?>
          <section class="flex-row space-between small-pad bg-color-dark">
            <div>
              <h1>Account Summary</h1>
              <label>Balance:&nbsp</label>
              <label>$<?php echo $accBalance; ?></label>
            </div>
            <div class="flex-col">
              <div class="flex-row">
                <div class="flex-col">
                  <p>Account Type:</p>
                  <p>Account Number:</p>
                </div>
                <div class="flex-col">
                  <p><?php echo $accType; ?></p>
                  <p><?php echo $accNum; ?></p>
                </div>
              </div>
              <button id="showBudget">Budget</button>
              <button id="showTransactions">Transactions</button>
            </div>
          </section>
            <!-- Transaction view shown by default or when the user hits 'Transactions' button -->
            <section id="TransactionView" class="flex-row space-between small-pad margin-top bg-color-dark <?php if(isset($_GET['budgetAmt'])){ echo "hidden"; } ?>">
              <h2 class="inline-block">Transaction History</h2>
              <form method="get" action="viewTransactions.php"/>
                <section class="flex-row space-between">
                  <div class="flex-col space-between small-margin-sides">
                    <h3>Sort Options</h3>
                    <div class="flex-col">
                      <select name="orderBy">
                        <option value="dateTime">Date</option>
                        <option value="type0">Credit</option>
                        <option value="type1">Debit</option>
                        <option value="amount">Amount</option>
                      </select>
                      <select name="sortBy">
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
            <section id="BudgetView" class="flex-row space-between small-pad margin-top bg-color-dark <?php if(!isset($_GET['budgetAmt'])){ echo "hidden"; } ?>">
              <h2 class="inline-block">Budget Summary</h2>
              <form method="get" action="viewTransactions.php">
                <div class="flex-row">
                  <div class="flex-col space-between small-margin-sides">
                    <h3 class="inline-block">Budget Settings</h3>
                    <button id="setBudget">Set Budget</button>
                  </div>
                  <div name="Sort-Options" class="inline-block box">
                    <h3>Sort Options</h3>
                    <div class="inline-block">
                      <select name="orderBy">
                        <option value="dateTime">Date</option>
                        <option value="credit">Credit</option>
                        <option value="debit">Debit</option>
                        <option value="amount">Amount</option>
                      </select>
                      <select name="sortBy">
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
                      <input name="fromDate" type="date" required/>
                      <input name="toDate" type="date" required/>
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
                      <p><?php if($setBudget){echo $total;} else{echo "??";}?></p>
                      <p><?php if($setBudget){echo $budget - $total;} else{echo "??";} ?></p>
                      <p><?php if($setBudget){if($budget - $total > 0){echo "Under budget!";}else{echo "Over budget!";}} else{echo "??";} ?></p>
                    </div>
                  </div>
                </div>
              </form>
            </section>
          <!-- Table begins here to display transactions -->
          <section class="flex-col small-pad margin-top bg-color-dark">
            <article class="entry space-between">
              <table>
                <tr>
                  <th>Type</th><th>Amount</th><th>Transaction Id</th></th><th>Note</th><th>Account Balance</th><th>Date</th>
                </tr>
                <?php
                  //  Get DB connection
                  $con = connect();
                  //  If transaction filter settings are applied build filter SQL
                  if(isset($_GET['minAmt']) && isset($_GET['maxAmt']) && isset($_GET['fromDate']) && isset($_GET['toDate'])) {
                    $stmt = filterSQLTransactions($con, $_GET['orderBy'], $_GET['sortBy'], $_GET['fromDate'], $_GET['toDate'], $_GET['minAmt'], $_GET['maxAmt']);
                  }
                  //  Else if Budget setttings are entered do a budget SQL query
                  else if (isset($_GET['budgetAmt'])) {
                    $setBudget = true;
                    $stmt = budgetSQLTransactions($con, $_GET['orderBy'], $_GET['sortBy'], $_GET['fromDate'], $_GET['toDate']);
                  }
                  //  Else get a default transaction query
                  else if (!isset($_GET['budgetAmt']) && !isset($_GET['Budget'])) {
                    $sql = "SELECT dateTime, note, amount, transId FROM transaction ORDER BY dateTime Desc";
                    $stmt = $con->prepare($sql);
                  }
                  //  Execute query
                  $stmt->execute();
                  if(isset($_GET['budgetAmt']))
                    $stmt->bind_result($date,$note,$amount,$tId);
                  else
                    $stmt->bind_result($date,$note,$amount,$tId);
                  //  Loop through rows of result_set and print
                  while($stmt->fetch()) {
                ?>
                  <tr>
                    <td>Type</td><td>$<?php echo $amount;?></td><td><?php echo $tId;?></td><td><?php echo $note; ?></td><td>$<?php echo($accBalance - $amount); ?></td><td><?php echo $date; ?></td>
                  </tr>
                <?php
                  } // Close while loop
                  //  Close DB connection
                  $stmt->close();
                ?>
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
    <footer>
    </footer>
  </body>
</html>
