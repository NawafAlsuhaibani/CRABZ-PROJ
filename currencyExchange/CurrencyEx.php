<?php
  session_start();
  if(!isset($_SESSION['userId']))
    header('location: /CRABZ-PROJ/views/viewLogin.php');
?>
<!doctype html>
<html>
  <head>
    <meta charset="UTF-8">
    <!-- <link rel="stylesheet" href="nav.css"> -->
    <link rel="stylesheet" href="../css/reset.css"/>
    <link rel="stylesheet" href="../css/layout.css"/>
    <link rel="stylesheet" href="../css/nav-header.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script type='text/javascript' src="../script/jquery-3.1.1.min.js"></script>
    <script type='text/javascript' src="../script/template.js"></script>

    <title>currencyEx</title>
  </head>
  <body class="bodyWrapper">
    <header id="header"></header>
    <div class="mainDivWrapper">
      <main class="mainWrapper">
        <div class="flex-col bg-color-dark margin-top">
          <div>
        		<label for="amount">amount:</label>
        		<input type="number" min="0" value="0" step="0.001" id="amount">
      		</div>
      		<div>
      			<label for="from">From Currency:</label>
      			<select name="from" id="from">
      			<option value="USD">USD</option>
      			<option value="CAD">CAD</option>
      			<option value="BTC">Bitcoin</option>
      			<option value="EUR">Euro</option>
      			<option value="AUD">Australian Dollar</option>
      			<option value="GBP">British Pound</option>
      			<option value="JPY">Japanese Yen</option>
      			</select>
      		</div>
      		<div>
      			<label for="from">To Currency:</label>
      			<select name="to" id="to">
      			<option value="USD">USD</option>
      			<option value="CAD">CAD</option>
      			<option value="BTC">Bitcoin</option>
      			<option value="EUR">Euro</option>
      			<option value="AUD">Australian Dollar</option>
      			<option value="GBP">British Pound</option>
      			<option value="JPY">Japanese Yen</option>
      			</select>
      		</div>
      		<div>
      			<button id="btn">Convert</button>
      		</div>
      		<div>
        			<input type="reset">
        		</div>
        		<div id="value">	</div>
            <script type="text/javascript">
           $(document).ready(function(){
            $("#btn").click(function(){
              var from = $("#from option:selected").val();
              var to = $("#to option:selected").val();
              var amount = $("#amount").val();
              $.ajax({
                url:"convert.php",
                method:"POST",
                data:{from:from ,to:to ,amount:amount},
                success:function(data){
                     $('#value').html("amount is: "+data);
                }
              });
            });
          });
        </script>
        </div>
      </main>
    </div>
  </body>
</html>
