<?php /* PHP page variables start here */
  session_start();
  $_SESSION['userId'] = 1;  //  Arbitary value **Assign upon loginPage
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/reset.css"/>
    <link rel="stylesheet" href="css/viewAccount.css"/>
    <title>CRABZ-View Account Information</title>
  </head>
  <body>
    <header id="pageHeader">
      <h1>This is a header</h1>
    </header>
    <section id="pageBody">
      <article id="leftColumn">
        <ul>
          <li><a href="viewAccount.php?Transaction=true">Transaction History</a></li>
          <li><a href="viewAccount.php?Budget=true">Budget Summary</a></li>
        </ul>
      </article>
      <article id="rightColumn">
        <?php /*  PHP to get account information  **change this to get redirected data from accountOveriew page */
          //  Get DB connection
          $con = mysqli_connect("localhost","crabz","88yGu2XF","crabz");
          //  Check if DB con is valid
          if (mysqli_connect_errno())
          {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
          }
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
          if(isset($_GET['budgetAmt'])) {
            $setBudget = true;
            //  Get variables from form
            $budget = $_GET['budget'];
            $budgetTo = $_GET['fromDate'];
            $budgetFrom = $_GET['toDate'];
            //  Get DB connection
            $con = mysqli_connect("localhost","crabz","88yGu2XF","crabz");
            //  Check if DB con is valid
            if (mysqli_connect_errno())
            {
              echo "Failed to connect to MySQL: " . mysqli_connect_error();
            }
            //  Prepare SQL
            $sql = "SELECT SUM(amount) AS total, dateTime, note, amount FROM transaction WHERE dateTime >= ? AND dateTime <= ?";
            //  Prepare SQL statement
            $stmt = $con->prepare($sql);
            //  Store variables for binding **Not sure if $_GET works in binding
            $stmt->bind_param('ss', $_GET["fromDate"],$_GET['toDate']);
            $stmt->execute();
            $stmt->bind_result($total,$date,$note,$amount);
            $stmt->fetch();
            $stmt->close();
          }
          mysqli_close($con);
         ?>
        <section class="sectionHeader">
          <div class="inline-block">
            <h1>Account Summary</h1>
            <label class="Orange-txt">Balance:&nbsp</label>
            <label>$<?php echo $accBalance; ?></label>
          </div>
          <div class="inline-block pull-right">
            <div class="inline-block">
              <p class="Orange-txt">Account Type:</p>
              <p class="Orange-txt">Account Number:</p>
            </div>
            <div class="inline-block">
              <p><?php echo $accType; ?></p>
              <p><?php echo $accNum; ?></p>
            </div>
          </div>
        </section>
        <section class="body-content">
          <?php
            if (isset($_GET['Transaction']) || (!isset($_GET['Budget']) && !isset($_GET['budgetAmt']))) {
          ?>
            <section class="sectionHeader">
              <h1 class="inline-block">Transaction History</h1>
              <form method="get" action="viewAccount.php"
                <div class="pull-right">
                  <div name="Sort-Options" class="inline-block box">
                    <h2>Sort Options</h2>
                    <div class="inline-block">
                      <select name="sortBy">
                        <option value="dateTime">Date</option>
                        <option value="type0">Credit</option>
                        <option value="type1">Debit</option>
                        <option value="amount">Amount</option>
                      </select>
                      <select name="orderBy">
                        <option value="Desc">Desc</option>
                        <option value="Asc">Asc</option>
                      </select>
                    </div>
                  </div>
                  <div name="Filter-Options" class="inline-block box">
                    <p>
                      <h2 class="inline-block">Filter Options</h2>
                      <button>Filter</button>
                    </p>
                    <p>
                      <label>From:</label>
                      <input name="fromDate" type="date"></input>
                      <label>To:</label>
                      <input name="toDate" type="date"></input>
                    </p>
                  </div>
                  <div class="inline-block">
                    <div class="inline-block">
                      <p>Minimum Amount:</p>
                      <p>Maximum Amount:</p>
                    </div>
                    <div class="inline-block">
                      <input type="number" class="block smallField" name="minAmt"/>
                      <input type="number" class="block smallField" name="maxAmt"/>
                    </div>
                  </div>
                </div>      <!-- End of filter and sorting options -->
              </form>
            </section>  <!-- End of sectionHeader -->
          <?php
            }
          ?>
          <?php
            if (isset($_GET['Budget']) || isset($_GET['budgetAmt'])) {
          ?>
            <section class="sectionHeader">
              <h1 class="inline-block">Budget Summary</h1>
              <form method="get" action="viewAccount.php">
                <div name="Budget-Options" class="pull-right">
                  <div name="Sort-Options" class="inline-block box">
                    <h2>Sort Options</h2>
                    <div class="inline-block">
                      <select name="sortBy">
                        <option value="dateTime">Date</option>
                        <option value="Credit">Credit</option>
                        <option value="Debit">Debit</option>
                        <option value="amount">Amount</option>
                      </select>
                      <select name="orderBy">
                        <option value="Desc">Desc</option>
                        <option value="Asc">Asc</option>
                      </select>
                    </div>
                  </div>
                  <div name="Budget-Settings" class="inline-block box">
                    <p>
                      <h2 class="inline-block">Budget Settings</h2>
                      <button>Budget</button>
                    </p>
                    <p>
                      <label>From:</label>
                      <input name="fromDate" type="date"/>
                      <label>To:</label>
                      <input name="toDate" type="date"/>
                    </p>
                    <p>
                      <label>Budget Amount:</label>
                      <input name="budgetAmt" type="Number" class="smallField"/>
                    </p>
                  </div>
                  <div name="Budget-Information" class="inline-block box">
                    <div class="inline-block">
                      <p>Spent:</p>
                      <p>Budget left:</p>
                      <p>You are:</p>
                    </div>
                    <div class="inline-block">
                      <p><?php if($setBudget){echo $total;} else{echo "??";}?></p>
                      <p><?php if($setBudget){echo $budget - $total;} else{echo "??";} ?></p>
                      <p><?php if($setBudget){if($budget - $total > 0){echo "Under budget!";}else{echo "Over budget!";}} else{echo "??";} ?></p>
                    </div>
                  </div>
                </div>
              </form>
            </section>
          <?php
            }
          ?>
          <div class="history">
            <?php
              //  Get DB connection
              $con = mysqli_connect("localhost","crabz","88yGu2XF","crabz");
              //  Check if DB con is valid
              if (mysqli_connect_errno())
              {
                echo "Failed to connect to MySQL: " . mysqli_connect_error();
              }
              //  Prepare SQL
              if(isset($_GET['minAmt']) && isset($_GET['maxAmt']) && isset($_GET['fromDate']) && isset($_GET['toDate'])) {
                if($_GET['sortBy'] === 'dateTime') {
                  if($_GET['orderBy'] === 'Desc')
                    $sql = "SELECT dateTime, note, amount FROM transaction WHERE amount >= ? AND amount <= ? AND dateTime >= ? AND dateTime <= ? ORDER BY dateTime Desc";
                  else
                    $sql = "SELECT dateTime, note, amount FROM transaction WHERE amount >= ? AND amount <= ? AND dateTime >= ? AND dateTime <= ? ORDER BY dateTime Asc";
                }
                //  Prepare SQL statement
                $stmt = $con->prepare($sql);
                //  Bind params
                $stmt->bind_param('ddss',$_GET['minAmt'],$_GET['maxAmt'],$_GET['fromDate'],$_GET['toDate']);
                //  Execute statement
                $stmt->execute();
                //  Bind result columns to variables
                $stmt->bind_result($date,$note,$amount);
              }
              else if (!isset($_GET['budgetAmt']) && !isset($_GET['Budget'])) {
                $sql = "SELECT dateTime, note, amount FROM transaction ORDER BY dateTime Desc";
                //  Execute query
                $stmt = $con->prepare($sql);
                $stmt->execute();
                $stmt->bind_result($date,$note,$amount);
              }
              if (isset($_GET['budgetAmt'])) {
                $setBudget = true;
                if($_GET['sortBy'] === 'dateTime') {
                  if($_GET['orderBy'] === 'Desc')
                    $sql = "SELECT dateTime, note, amount FROM transaction WHERE dateTime >= ? AND dateTime <= ? ORDER BY dateTime Desc";
                  else
                    $sql = "SELECT dateTime, note, amount FROM transaction WHERE dateTime >= ? AND dateTime <= ? ORDER BY dateTime Asc";
                }
                //  Prepare SQL statement
                $stmt = $con->prepare($sql);
                //  Bind params
                $stmt->bind_param('ss',$_GET['fromDate'],$_GET['toDate']);
                //  Execute statement
                $stmt->execute();
                //  Bind result columns to variables
                $stmt->bind_result($date,$note,$amount);
              }
              //  Loop through rows of result_set
              while($stmt->fetch()) {
            ?>
            <section class="entry">
              <h3 class="inline-block"><?php echo $date; ?></h3>
              <div name="Transaction-Information" class="inline-block box">
                <div class="inline-block">
                  <p>Type:</p>
                  <p>Transaction Id:</p>
                </div>
                <div class="inline-block">
                  <p>?</p>
                  <p>?</p>
                </div>
              </div>
              <div name="Transaction-Description" class="inline-block box">
                <p><?php echo $note; ?></p>
              </div>
              <div name="Transaction-Type" class="inline-block box">
                <label>Debit/Credit:</label>
                <label>$<?php echo $amount; ?></label>
              </div>
              <div name="Transaction-Balance" class="inline-block box">
                <label>Account Balance:</label>
                <label>$<?php echo($accBalance - $amount); ?></label>
              </div>
            </section>  <!-- End of entry -->
            <?php
              } // Close while loop
              $stmt->close();
            ?>
          </div>  <!-- End of history -->
        </section>  <!-- End of bodyContent -->
      </article>
    </section>  <!-- End of pageBody -->
    <footer id="pageFooter">
      <h1>This is a footer</h1>
    </footer>
  </body>
</html>
