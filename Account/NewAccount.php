<?php
    session_start();
    $_SESSION['userId'] = 1;

    if (isset($_POST['submit'])){
        $valid = TRUE;
        //Get variables from the form on NewAccount
        $accnum = $_REQUEST['accnum'];
        $acctype = $_REQUEST['acctype'];
        $balance = $_REQUEST['balance'];
        $instnum = $_REQUEST['instnum'];

        if (!isset($accnum,$acctype,$instnum,$balance)){
            echo "Please complete all fields.";
            echo "<br>";
            $valid = FALSE;
        }

        //ceil(log10($number)) is the number's length
        //Checking that the account number is at least 5 characters long
        if (ceil(log10($accnum)) < 5){
            echo "Account number is not long enough";
            echo "<br>";
            $valid = FALSE;
        }

        //Connecting to database
        $con = mysqli_connect("localhost", "crabz", "88yGu2XF", "crabz");

        if (mysqli_connect_errno()){
            echo "Failed to connect to MySQL: " . mysql_connect_error();
        }
        //Checking for if the entered institution number is within the database
        $sql = $con->prepare("SELECT instName FROM institution WHERE instNum = ?");
        $sql->bind_param('i', $instnum);

        $sql->execute();

        $sql->bind_result($rst);

        $sql->fetch();

        unset($sql);
        //Checking entered info vs database info
        if (empty($rst)){
            echo "The institution number you have entered is invalid.";
            echo "<br>";
            $valid = FALSE;
        }
        //Checking for if the entered account number is already in the database
        $sql = $con->prepare("SELECT accnum FROM account WHERE ownerId = ?");
        $sql->bind_param('i',$_SESSION['userId']);

        $sql->execute();

        $sql->bind_result($rst);

        $sql->fetch();

        unset($sql);
        unset($rst);
        //Checking entered info vs database info
        if (!empty($rst)){
            echo "The entered account number is already linked to an account";
            echo "<br>";
            $valid = FALSE;
        }

        //Adding the entered account to the database linked to the logged in account
        if ($valid){
            $sql = $con->prepare("INSERT INTO account (accNum, accType, balance, instNum, ownerId) VALUES (?, ?, ?, ?, ?)");
            $sql->bind_param('iidii',$accnum, $acctype, $balance, $instnum, $_SESSION['userId']);

            $sql->execute();
            echo "Your account has been updated";
        }
        $sql->close();
        $con->close();
    }

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/reset.css"/>
    <link rel="stylesheet" href="../css/layout.css"/>
    <link rel="stylesheet" href="../css/nav-header.css">
    <script type='text/javascript' src="script/jquery-3.1.1.min.js"></script>
    <script type='text/javascript' src="script/transfers.js"></script>
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
        <div class="flex-col small-pad bg-color-dark">
          <h1 class="text-center">New Account</h1>
          <form action="NewAccount.php" method="post">
            Account Number: <br>
            <input type="number" name = "accnum" maxlength="12" required> <br>
            Account Type: <br>
            <input type="radio" name="acctype" value=0 checked="checked"> Chequing
            <input type="radio" name="acctype" value=1> Savings <br>
            Balance: <br>
            <input type="number" step="0.01" name="balance" required> <br>
            Institution Number: <br>
            <input type="number" name ="instnum" required> <br>
            <input type="submit" value="submit" name="submit" required>
          </form>
          <a href = "Account.php">Back to Account</a>
        </div>
      </main>
    </div>
    <footer>
    </footer>
  </body>
</html>
<?php

?>
