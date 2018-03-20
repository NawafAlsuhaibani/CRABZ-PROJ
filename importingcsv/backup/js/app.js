$(document).ready(function(){	
	"use strict";
	$('#barBtn').click(function () {		
  	$('#pie').addClass('hidden');
	$('#tabledata').addClass('hidden');
  $('#bar').removeClass('hidden');
});	
	$('#pieBtn').click(function () {		
  	$('#bar').addClass('hidden');
	$('#tabledata').addClass('hidden');
  $('#pie').removeClass('hidden');
});	
	$('#tableBtn').click(function () {		
  	$('#pie').addClass('hidden');
	$('#bar').addClass('hidden');
  $('#tabledata').removeClass('hidden');
});	
	$.ajax({
		url: "http://localhost/cosc310/importingcsv/data.php",
		method: "GET",
		success: function(data) {
			console.log(data);
			var date = [];
			var amt = [];
			for(var i in data) {
				date.push(data[i].dateNtime);
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
});