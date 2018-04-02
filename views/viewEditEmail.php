<?php
    session_start();
    $_SESSION['admin'] = false;
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
    <script type='text/javascript' src="../script/viewEditEmail.js"></script>
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
        <form action="EditEmail.php" method="post" id="changeEmailForm">
          enter current password <br>
          <input type="password" name="password" required/> <br>
          Enter new email: <br>
          <input type="text" name = "email" required> <br>
          <input type="submit" value ="submit" name="submit"> <br>
        </form>
        <a href = "viewAccount.php">Back to Account</a>
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
