<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/reset.css"/>
    <link rel="stylesheet" href="../css/layout.css"/>
    <link rel="stylesheet" href="../css/nav-header.css">
    <script type='text/javascript' src="../script/jquery-3.1.1.min.js"></script>
    <script type='text/javascript' src="../script/template.js"></script>
    <script type='text/javascript' src="../script/createAccount.js"></script>
    <title>CRABZ-View Account Information</title>
  </head>
  <body class="bodyWrapper">
    <header id="header">
    </header>
    <div class="mainDivWrapper singleColumn-Margin">
      <main class="mainWrapper">
        <div class="flex-col small-pad bg-color-dark">
          <h1 class="text-center">New Account</h1>
          <form action="NewAccount.php" method="post" id="createAccForm">
            Account Number: <br>
            <input type="number" name = "accnum" maxlength="12" required id="accNum"> <br>
            Account Type: <br>
            <input type="radio" name="acctype" value=0 checked="checked"> Chequing
            <input type="radio" name="acctype" value=1> Savings <br>
            Balance: <br>
            <input type="number" step="0.01" name="balance" required id="balance"> <br>
            Institution Number: <br>
            <input type="number" name ="instnum" required id="instNum"> <br>
            <input type="submit" value="submit" name="submit" required>
          </form>
          <a href = "viewAccount.php">Back to Account</a><lable id="feedbackMsg"></label>
        </div>
      </main>
    </div>
    <footer>
    </footer>
  </body>
</html>
