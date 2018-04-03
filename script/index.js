function getAccounts() {
  $.ajax({
    type: 'post',
    url:  '../lib/transactions/getAccounts.php',
    success: function (data) {
      $('#accounts').html(data);
      num = $("#accounts option:first").val();
      getAccountInfo(num);
      getTransactions(num);
    }
  })
}

//  Sets HTML with selected account data
//**TODO** change accNum to hashed
function getAccountInfo() {
  $.ajax({
    type: 'post',
    url:  '../lib/transactions/getAccountInfo.php',
    data: {accNum: num},
    //dataType: 'text',
    success: function(str) {
    //  var balance = "<?php echo $_POST['balance']; ?>";
      var csf = str.split(',');
      balance = csf[1];
      var accNum = csf[0].substring(csf[0].length-3,csf[0].length);
      $('#accNum').html('*****'+csf[0]);
      $('#balance').html("$" + balance);
      $('#accType').html(csf[2]);
      getTransactions(num, balance);
    },
    error: function(xhr, status, err) {
      alert(status);
      alert(err);
    }
  })
}

function getTransactions() {
  $.ajax({
    type: 'post',
    data: {accNum: num, balance: balance, limit:$('#limit').val()},
    url:  '../lib/transactions/getAllTransactions.php',
    success: function(results) {
      $('#transactionTable').html('<tr><th>Date</th><th>Amount</th></th><th>Type</th></tr>');
      $('#transactionTable').append(results);
    }
  })
}

$(document).ready(function(){

  //  Updates account information on selected account change
  $('#accounts').change(function(e) {
    num = $('#accounts').val();
    getAccountInfo();
  });

  $('#limit').change(function(e) {
    getTransactions();
  });

  getAccounts();

});
