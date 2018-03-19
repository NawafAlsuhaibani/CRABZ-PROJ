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
    <!-- Login form starts here -->
		<form action="loginConfirm.php" method="post">
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
