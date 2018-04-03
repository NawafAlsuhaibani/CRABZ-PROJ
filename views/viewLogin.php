<?php
  session_start();
  if(isset($_SESSION['userId'])){
    header('location: ../views/viewAccount.php');
  }
 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/reset.css"/>
    <link rel="stylesheet" href="../css/layout.css"/>
    <link rel="stylesheet" href="../css/nav-header.css">
    <link rel="stylesheet" href="../css/login.css">
    <script type='text/javascript' src="../script/jquery-3.1.1.min.js"></script>
    <script type='text/javascript' src="../script/template.js"></script>
    <title>CRABZ-View Account Information</title>
  </head>
  <body class="bodyWrapper">
    <header id="header"></header>
    <?php if(isset($_SESSION['loginError'])) { ?>
    <p class="position error" style="margin-bottom: 0;">
    Your username or password was entered incorrectly.
    </p>
    <?php } ?>
    <!-- Login form starts here -->
		<form action="../lib/login/loginConfirm.php" method="post">
      <div class="position">
        <h2 class="heading">Log in to your CRABZ account</h2>
        <label class="label">Username:</label>
        <input class="input" type="text" placeholder="Enter Username" name="uname" required>
        <label class="label">Password:</label>
        <input class="input" type="password" placeholder="Enter Password" name="psw" required>
        <button class="logbt" type="submit">Sign In</button>
      </div>
		</form>
  </body>
</html>
