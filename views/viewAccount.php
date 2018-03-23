<?php
    session_start();
    $_SESSION['admin'] = false;
    if(!isset($_SESSION['userId']))
      header('location: ../views/viewLogin.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/reset.css"/>
    <link rel="stylesheet" href="../css/layout.css"/>
    <link rel="stylesheet" href="../css/nav-header.css">
    <script type='text/javascript' src="../script/jquery-3.1.1.min.js"></script>
    <script type='text/javascript' src="../script/template.js"></script>
    <script type='text/javascript' src="../script/viewAccount.js"></script>
    <title>CRABZ-Account page</title>
</head>
  <body class="bodyWrapper">
    <header id="header">
    </header>
    <div class="mainDivWrapper singleColumn-Margin">
      <main class="mainWrapper">
        <div class="flex-col small-pad bg-color-dark">
          <h1>Account Information</h1>
          <table>
            <tr>
                <td>Name: </td>
                <td id="name"></td>
            </tr>

            <tr>
                <td>Username: </td>
                <td id="userName"></td>
            </tr>

            <tr>
                <td>Email: </td>
                <td id="email"></td>
            </tr>

            <tr id="accounts">
                <td>Accounts:</td>
            </tr>
        </table>
        <a href = "viewAddAccount.php">New Account</a> <br>
        <a href = "viewEditEmail.php">Edit Email</a> <br>
        <a href = "viewEditPassword.php">Edit Password</a>
        <a href = "../ticket/reviewTicket.php">View Tickets</a>
        <a href = "../ticket/submitTicket.php">Submit Ticket</a>
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
