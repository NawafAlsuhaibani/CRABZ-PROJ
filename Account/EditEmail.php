<?php
    session_start();
    //If the form has been submitted, this runs to check that everything was submitted correctly
    if(isset($_POST['submit'])){
        //initializing the user's entered emails
        $newmail1 = $_POST['newmail1'];
        $newmail2 = $_POST['newmail2'];

        //Connecting to the database
        $con = mysqli_connect("localhost", "crabz", "88yGu2XF", "crabz");

        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysql_connect_error();
        }
        //getting the previous email from the database
        $sql = $con->prepare("SELECT email FROM user WHERE userId = ?");
        $sql->bind_param('i', $_SESSION['userId']);

        $sql->execute();

        $sql->bind_result($rst);

        $sql->fetch();
        unset($sql);
        //Checks that the user entered an email, that it doesn't match their current email, and it matches the other one they enetered
        if (!empty($newmail1) && $rst != $newmail1 && $newmail1 == $newmail2) {
            echo "Change complete";
            //Setting their new email
            $sql = $con->prepare("UPDATE user SET email = ? WHERE userId = ?");
            $sql->bind_param('si',$newmail1, $_SESSION['userId']);
            $sql->execute();
            //If their emails match but it's the same as their current email
        }elseif ($rst == $newmail1 && $newmail1 == $newmail2){
            echo "You must enter a new email";
        }else{
            echo "Invalid";
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
    <script type='text/javascript' src="../script/jquery-3.1.1.min.js"></script>
    <script type='text/javascript' src="../script/template.js"></script>
    <title>CRABZ-View Account Information</title>
  </head>
  <body class="bodyWrapper">
    <header id="header">
    </header>
    <div class="mainDivWrapper singleColumn-Margin">
      <main class="mainWrapper">
        <div class="flex-col small-pad bg-color-dark">
        <h1>Edit Email</h1>
        <form action="EditEmail.php" method="post">
            Enter new email: <br>
            <input type="text" name = "newmail1"> <br>
            Confirm new email: <br>
            <input type="text" name = "newmail2"> <br>
            <input type="submit" value ="submit" name="submit"> <br>
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

?>
