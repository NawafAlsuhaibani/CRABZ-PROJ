<?php
  session_start();
  include('../lib/db_credentials.php');
  include('../lib/getTransfers.php');
  $_SESSION['userId'] = 1;  //  Arbitary value **Assign upon loginPage
  $_SESSION['sentTransfer'] = false;
  $_SESSION['hasClaimed'] = false;
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
          <a href="../transfers/viewTransfers.php">Transfer</a>
          <a href="../transactions/viewTransactions.php">Summary</a>
          <a href="../account/Account.php">Account</a>
        </div>
        <div>
          <a href="../login/login.html">Login</a>
          <a href="../login/login.html">Sign up</a>
        </div>
      </nav>
    </header>
    <div class="mainDivWrapper singleColumn-Margin">
      <main class="mainWrapper">
        <section class="flex-row space-between small-pad bg-color-dark"> <!-- Header bar -->
         <div>
           <h1 class="text-color-light">Transfers Overview</h1>
           <form method="post" action="viewTransfers.php">
             <div>
               <input type="radio" name="status" value="1" <?php if(isset($_POST['status']) && $_POST['status'] == '1'){echo 'checked="checked"';} ?>/><label>Successful</label>
               <input type="radio" name="status" value="0" <?php if(isset($_POST['status']) && $_POST['status'] == '0'){echo 'checked="checked"';} ?>/><label>Pending</label>
               <input type="radio" name="status" value="-1" <?php if(isset($_POST['status']) && $_POST['status'] == '-1'){echo 'checked="checked"';} ?>/><label>Failed</label>
             </div>
             <div>
               <input type="radio" name="to-from" value="Sent" <?php if(isset($_POST['to-from']) && $_POST['to-from'] == 'Sent'){echo 'checked="checked"';} ?>/><label>Sent</label>
               <input type="radio" name="to-from" value="Received" <?php if(isset($_POST['to-from']) && $_POST['to-from'] == 'Received'){echo 'checked="checked"';} ?>/><label>Received</label>
               <input type="submit" value="Filter"/>
             </div>
           </form>
         </div>
         <h2 id="transferType"><?php if(isset($_POST['to-from']))echo $_POST['to-from'];else echo 'All Transfers'; ?></h2>
         <div class="flex-col space-between">
          <p><h3 class="text-color-light inline-block">Total: </h3><label>?</label></p>
          <button id="sendFundsBtn">Send Funds</button>
          <button id="viewTransfersBtn">View Transfers</button>
        </div>
        </section> <!-- Header ends -->

        <section id="transferForm" class="flex-row space-between small-pad margin-top bg-color-dark hidden">
          <h2>Enter details</h2>
            <form method="post" action="sendTransfer.php">
              <div class="flex-row space-between">
                <input type="submit" value="Send Transfer" class="small-margin-right" required/>
                <div class="flex-col small-margin-right">
                  <label>Choose an account to transfer from:</label>
                  <select name="accounts" required>
                    <?php
                    $con = connect();

                    $stmt = getAccounts($con, $_SESSION['userId']);

                    $stmt->bind_result($accType, $balance, $accNum);

                    $stmt->fetch();

                    while($stmt->fetch()) {
                    ?>
                    <option value="<?php echo $accNum; ?>"><?php echo getAccType($accType); ?> &nbsp$<?php echo $balance; ?></option>
                    <?php
                    }
                    $stmt->close();
                    ?>
                  </select>
                </div>
              <div class="flex-col small-margin-right">
                <label>Send to</label><input name="sendTo" type="text" placeholder="Account #" required/>
              </div>
              <div class="flex-col small-margin-right">
                <label>Amount</label><input name="amount" type="text" placeholder="Amount" required/>
              </div>
              <div class="flex-col small-margin-right">
                <label>Note</label><textarea name="note" placeholder="Transfer Description" required></textarea>
              </div>
            </form>
          </div>
        </section>

        <section id="transferContainer" class="flex-col small-pad margin-top bg-color-dark"> <!-- Container for transfers -->
          <article class="entry space-between">
            <table>
              <tr>
                <th>Status</th><th>Amount</th><th id="sender-receiver">Sender</th></th><th>Reciever</th><th>Note</th><th>Date</th>
              </tr>
              <?php
              //  Get DB connection
              $con = connect();

              if(isset($_POST['status']) && isset($_POST['to-from']))
                $stmt = getTransfersFiltered($con, $_POST['status'], $_POST['to-from'], $_SESSION['userId']);
              else if(isset($_POST['status']))
                $stmt = getTransfersByStatus($con, $_POST['status'], $_SESSION['userId']);
              else if(isset($_POST['to-from']))
                $stmt = getTransfersByType($con, $_POST['to-from'], $_SESSION['userId']);
              else
                $stmt = getTransfersAll($con, $_SESSION['userId']);

              $stmt->execute();
              $stmt->bind_result($tId, $status,$amount,$fromAcc,$toAcc,$note,$date);
              while($stmt->fetch()) {

              ?>
              <tr>
                <td><?php if(isClaimable($toAcc, $_SESSION['userId']) && $status == 0) {echo '<a href="confirmTransfer.php?transferId=';  echo $tId; echo '">'; echo getTransType($status); echo '</a>';}else echo getTransType($status); ?></td>
                <td><?php echo $amount; ?></td>
                <td><?php echo $fromAcc; ?></td>
                <td><?php echo $toAcc; ?></td>
                <td><?php echo $note; ?></td>
                <td><?php echo $date; ?></td>
              </tr>
              <?php
              }
              $stmt->close();
              ?>
            </table>

          </article>
        </section>  <!-- Container for transfers ends -->
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
