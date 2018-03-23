<?php
  session_start();
  if(!isset($_SESSION['userId']))
    header('location: ../views/viewLogin.php');
?>
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/reset.css" />
    <link rel="stylesheet" href="../css/layout.css" />
    <link rel="stylesheet" href="../css/nav-header.css">
    <script type="text/javascript" src="Chart.min.js"></script>
	<script type="text/javascript" src="jquery.min.js"></script>
  <script type="text/javascript" src="../script/template.js"></script>
  <script type="text/javascript" src="getAccounts.js"></script>
   <script>
	$(document).ready(function(){
				function createTableByJqueryEach(data)
{


  var eTable="<table id=sh><thead><tr><th colspan='3'></th></tr><tr><th>Total $</th><th>Date</th></tr></thead><tbody>"
  $.each(data,function(index, row){
    eTable += "<tr>";
    $.each(row,function(key,value){
      eTable += "<td>"+value+"</td>";
    });
    eTable += "</tr>";
  });
  eTable +="</tbody></table>";
  $('#eachTable').html(eTable);
}
		$('#date').change(function(){
			var x = $("#date").val();
			if(x=='1'){
			   $('#month').hide();
			   }
		else if(x=='2'){
			$('#month').show();
		}
		});
    $("#sh").click(function(){
		var x = $("#date").val();
		if(x=='1'){
			$.ajax({
		url: "data.php",
		method: "GET",
		success: function(data) {
			createTableByJqueryEach(data);
			console.log(data);
			var date = [];
			var amt = [];
			for(var i in data) {
				date.push(data[i].month);
				amt.push(data[i].total);
			}
			var chartdata = {
				labels: date,
				datasets : [
					{
						label: 'Total spending',
						backgroundColor: 'antiquewhite',
						hoverBackgroundColor: 'red',
						color: 'blue',
						borderColor: 'green',
						data: amt
					}
				]
			};
			var ctx1 = $("#mycanvas1");
			var ctx2 = $("#mycanvas2");
			var barGraph = new Chart(ctx1, {
				type: 'bar',
				data: chartdata,
			});
						var barGraph = new Chart(ctx2, {
				type: 'pie',
				data: chartdata
			});
		},
		error: function(data) {
			console.log(data);
		}

	});
			$("#mycanvas1").hide();
			$("#mycanvas2").hide();
		}
		else if(x=='2'){
			var mon = $('#month').val();

			$.ajax({
		url: "datamon.php",
		method: "GET",
		data: {mon : mon},
		success: function(data) {
		createTableByJqueryEach(data);


			console.log(data);
			var date = [];
			var amt = [];
			for(var i in data) {
				date.push(data[i].month);
				amt.push(data[i].total);
			}
			var chartdata = {
				labels: date,
				datasets : [
					{
						label: 'Total spending',
						backgroundColor: 'antiquewhite',
						hoverBackgroundColor: 'red',
						color: 'blue',
						borderColor: 'green',
						data: amt
					}
				]
			};
			var ctx1 = $("#mycanvas1");
			var ctx2 = $("#mycanvas2");
			var barGraph = new Chart(ctx1, {
				type: 'bar',
				data: chartdata,
			});
						var barGraph = new Chart(ctx2, {
				type: 'pie',
				data: chartdata
			});
		},
		error: function(data) {
			console.log(data);
		}
	});
			$("#mycanvas1").hide();
			$("#mycanvas2").hide();
		}


	});



});
	</script>
	<script>
	$(document).ready(function(){
		$("#pieBtn").click(function(){
			$("#mycanvas2").show();
			$("#mycanvas1").hide();
			$("#eachTable").hide();

		});
		$("#barBtn").click(function(){
			$("#mycanvas1").show();
			$("#mycanvas2").hide();
			$("#eachTable").hide();

		});
		$("#tableBtn").click(function(){
			$("#mycanvas1").hide();
			$("#mycanvas2").hide();
			$("#eachTable").show();

		});



	});

	</script>
<style>
						#month {
							display: none;
						}
</style>
    <title>csv importing</title>
</head>
<body class="bodyWrapper">
    <header id="header">
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
                            <select id="accounts" name="accounts">
                            </select>
                    </form>
                    <select name="date" id="date">
                    	<option value="1">Year</option>
                    	<option value="2">Month</option>
                    </select>
                    <select name="month" id="month">
                    	<option value="1">1</option>
                    	<option value="2">2</option>
                    	<option value="3">3</option>
                    	<option value="4">4</option>
                    	<option value="5">5</option>
                    	<option value="6">6</option>
                    	<option value="7">7</option>
                    	<option value="8">8</option>
                    	<option value="9">9</option>
                    	<option value="10">10</option>
                    	<option value="11">11</option>
                    	<option value="12">12</option>
                    </select>
                    <button id="sh" class="btndiv" name="sh">Go</button>
           <button id="barBtn" class="btndiv">bar chart</button>
          <button id="pieBtn" class="btndiv">pie chart</button>
          <button id="tableBtn" class="btndiv">table</button>

                </div>
            </section>
            <section class="flex-col small-pad margin-top bg-color-dark hidden" id="bar">
                <article class="entry space-between">
                	<div class="chart-container">
						<article></article>
					</div>
                </article>
            </section>
            <section class="flex-col small-pad margin-top bg-color-dark hidden" id="pie">
                <article class="entry space-between">
                	<div class="chart-container">
						<article></article>
					</div>
                </article>
            </section>
            <section class="flex-col small-pad margin-top bg-color-dark" id="tabledata">
                <article class="entry space-between">
                  <div id="eachTable"></div>
                  <canvas id="mycanvas1"></canvas>
                  <canvas id="mycanvas2"></canvas>
            </section>
            <!-- End of entry -->
        </main>
    </div>
</body>
</html>
