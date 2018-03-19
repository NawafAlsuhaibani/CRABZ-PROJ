<?php
  session_start();
  if(!isset($_SESSION['userId']))
    header('location: /CRABZ-PROJ/views/viewLogin.php');
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/reset.css"/>
    <link rel="stylesheet" href="css/layout.css"/>
    <link rel="stylesheet" href="css/nav-header.css">
    <script type='text/javascript' src="script/jquery-3.1.1.min.js"></script>
    <script type='text/javascript' src="script/template.js"></script>
    <title>CRABZ-View Account Information</title>
  </head>
  <body class="bodyWrapper">
    <header id="header">
    </header>
    <div class="mainDivWrapper singleColumn-Margin">
      <main class="mainWrapper">
        <h1>Index Page!</h1>
      </main>
      <!--
      <nav class="rightColumn">
      </nav>
      <aside class="leftColumn">
      </aside>
      -->
    </div>
    <footer id="footer">
    </footer>
  </body>
</html>
