<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/reset.css"/>
    <link rel="stylesheet" href="css/layout.css"/>
    <link rel="stylesheet" href="css/nav-header.css">
    <link rel="stylesheet" href="css/login.css">
  
    <title>CRABZ-View Account Information</title>
  </head>
  <body class="bodyWrapper">
    <header>
      <nav id="headerNav" class="space-between">
        <div>
          <a href="">Home</a>
          <a href="CurrencyEx.html">Currency exchange</a>
          <a href="viewTransfers.php">Transfer</a>
          <a href="viewTransactions.php">Summary</a>
          <a href="Account.php">Account</a>
        </div>
        <div>
          <a href="login.html">Login</a>
          <a href="register.html">Sign up</a>
        </div>
      </nav>
    </header>
<!-- Login form starts here -->
<div class="position error">
  <p style="margin-bottom: 0;">
    Your username or password was entered incorrectly.
  </p>
</div>
		<form action="loginConfirm.php" method="post">
      <div class="position">
      <h2 class="heading">Log in to your CRABZ account</h2>
      <label class="label">Username:</label>
      <input class="input" type="text" placeholder="Enter Username" name="uname" required>
      <label class="label">Password:</label>
      <input class="input" type="password" placeholder="Enter Password" name="psw" required>
      <button class="logbt" type="submit">Sign Up</button>

      </div>
		  </form>


  </body>



 </html>
