<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/reset.css" />
    <link rel="stylesheet" href="../css/layout.css" />
    <link rel="stylesheet" href="../css/nav-header.css">
    <script type="text/javascript" src="../script/jquery-3.1.1.min.js"></script>
	<script type="text/javascript" src="js/Chart.min.js"></script>
	<script type="text/javascript" src="js/app.js"></script>
    <title>csv importing</title>
</head>
<body class="bodyWrapper">
    <header>
      <nav id="headerNav" class="space-between">
        <div>
          <a href="">Home</a>
          <a href="../currencyExchange/CurrencyEx.html">Currency exchange</a>
          <a href="../transfers/viewTransfers.php">Transfer</a>
          <a href="../transactions/viewTransactions.php">Summary</a>
          <a href="../account/Account.php">Account</a>
        </div>
        <div>
          <a href="../login/login.html">Login</a>
          <a href="">Sign up</a>
        </div>
      </nav>
    </header>
    <div class="mainDivWrapper singleColumn-Margin">
        <main class="mainWrapper">
            <section class="flex-row space-between small-pad bg-color-dark">
                <div>
                    <h1>Import csv file</h1>
                    <p>Note, please make sure that your csv file has the following format: date,$amount,catagory</p>
                    <form action="csvhandling.php" method="post" enctype="multipart/form-data">
                        <p>
                            <input type="file" name="file1">
                            <input type="submit" value="import file!" name="import"> </p>
                    </form>
                    <button id="barBtn" class="btndiv">bar chart</button>
          <button id="pieBtn" class="btndiv">pie chart</button>
          <button id="tableBtn" class="btndiv">table</button>
                </div>
            </section>
            <section class="flex-col small-pad margin-top bg-color-dark hidden" id="bar">
                <article class="entry space-between">
                	<div class="chart-container">
						<article><canvas id="mycanvas1"></canvas></article>
					</div>
                </article>
            </section>
            <section class="flex-col small-pad margin-top bg-color-dark hidden" id="pie">
                <article class="entry space-between">
                	<div class="chart-container">
						<article><canvas id="mycanvas2"></canvas></article>
					</div>
                </article>
            </section>
            <section class="flex-col small-pad margin-top bg-color-dark" id="tabledata">
                <article class="entry space-between">
                    <?php include( 'csvhandling.php'); get_all_record(); ?> </article>
            </section>
            <!-- End of entry -->
        </main>
    </div>
</body>
</html>