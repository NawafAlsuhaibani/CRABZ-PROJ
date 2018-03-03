<?php
    session_start();
    $_SESSION['userId'] = 1;
    //If the form has been submitted, this runs to check that everything was submitted correctly
    if (isset($_POST['submit'])){
        //initializing the user's entered passwords
        $newpass1 = $_POST['newpass1'];
        $newpass2 = $_POST['newpass2'];

        //connecting to the database
        $con = mysqli_connect("localhost", "crabz", "88yGu2XF", "crabz");

        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysql_connect_error();
        }
        //getting the previous password from the database
        $sql = $con->prepare("SELECT password FROM user WHERE userId = ?");
        $sql->bind_param('i', $_SESSION['userId']);

        $sql->execute();

        $sql->bind_result($rst);

        $sql->fetch();
        unset($sql);
        //Checks that the user has entered a password, that it doesn't match their current password, and the two they entered match
        if(!empty($newpass1) && $rst != $newpass1 && $newpass1 == $newpass2){
            echo "Change complete";
            //Setting their new password
            $sql = $con->prepare("UPDATE user SET password = ? WHERE userId = ?");
            $sql->bind_param('si', $newpass1,$_SESSION['userId']);
            $sql->execute();
            //If their passwords match but it's the same as their current password
        }elseif ($rst == $newpass1 && $newpass1 == $newpass2){
            echo "You must enter a new password";
        }else{
            echo "Invalid";
        }

    }
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/reset.css"/>
    <link rel="stylesheet" href="../css/layout.css"/>
    <link rel="stylesheet" href="../css/nav-header.css">
    <script type='text/javascript' src="../script/jquery-3.1.1.min.js"></script>
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
<h1>Edit Password</h1>
<form action="EditPassword.php" method="post">

    Enter new password: <br>
    <input type="text" name="newpass1"> <br>
    Confirm new email: <br>
    <input type="text" name="newpass2"> <br>
    <input type="submit" value="submit" name="submit"> <br>

</form>
<a href = "Account.php">Back to Account</a>
</div>
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

<?php
$sql->close();
$con->close();
?>
