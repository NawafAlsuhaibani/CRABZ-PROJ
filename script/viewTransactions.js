var num, balance, budget;

$(document).ready(function() {

  //  Methods to change displayed div
  $('#showBudget').click(function () {
    $('#TransactionView').addClass('hidden');
    $('#BudgetView').removeClass('hidden');
  });

  $('#showTransactions').click(function () {
    $('#TransactionView').removeClass('hidden');
    $('#BudgetView').addClass('hidden');
  });

  // Populates select list with user getAccounts
  //**TODO** change value of <option> to hashed accNum
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

  //  Gets all transactions for selected account
  //**TODO**  Change DB to hold account balance at time and grab that
  // to replace passing 'balance' through as an arg (this calculates an
  // arbitary balance)
  function getTransactions() {
    $.ajax({
      type: 'post',
      data: {accNum: num, balance: balance, limit:$('#limit').val()},
      url:  '../lib/transactions/getAllTransactions.php',
      success: function(results) {
        $('#transactionTable').html('<tr><th>Date</th><th>Amount</th></th><th>Type</th><th>Balance</th></tr>');
        $('#transactionTable').append(results);
      }
    })
  }

  //  Sets the budget information
  function filterTransactions() {
    $.ajax({
      type: 'post',
      data: {filterMethod: 'transaction', bindMethod: 'date', sortBy: $('select[name=sortBy]').val(), orderBy: $('select[name=orderBy]').val(),
            accNum: num, balance: balance,
            datefrom:  $('input[name=fromDate]').val(), dateto:  $('input[name=toDate]').val(),
            amtlower:  $('input[name=minAmt]').val(), amtupper:  $('input[name=maxAmt]').val(),
            limit:$('#limit').val()
          },
      url:  '../lib/transactions/filterTransactions.php',
      success: function(results) {
              $('#transactionTable').html('<tr><th>Date</th><th>Amount</th></th><th>Type</th><th>Balance</th></tr>');
        $('#transactionTable').append(results);
      },
      error: function(xhr, status, err) {
        alert(status);
        alert(err);
      }
    })
  }

  function filterBudget() {
    $.ajax({
      type: 'post',
      data: {filterMethod: 'budget', bindMethod: 'date', sortBy: $('select[name=sortByB]').val(), orderBy: $('select[name=orderByB]').val(),
            budgetAmt: $('input[name=budgetAmt]').val(), datefrom:  $('input[name=fromDateB]').val(), dateto:  $('input[name=toDateB]').val(),
            balance: balance, accNum: num
            },
      url:  '../lib/transactions/filterTransactions.php',
      success:  function(results) {
        budget = $('input[name=budgetAmt]').val();
                $('#transactionTable').html('<tr><th>Date</th><th>Amount</th></th><th>Type</th><th>Balance</th></tr>');
        $('#transactionTable').append(results);
        getBudget();
      }
    })
  }

  function getBudget() {
    $.ajax({
      type: 'post',
      data: {
            datefrom:  $('input[name=fromDateB]').val(), dateto:  $('input[name=toDateB]').val(), accNum: num
            },
      url:  '../lib/transactions/getBudget.php',
      success:  function(results) {
        $('#budgetSpent').html(results);
        $('#budgetLeft').html(budget - results);
        if(budget - results <= 0)
          $('#budgetStatus').html("Over budget!");
        else
          $('#budgetStatus').html("Under budget!");
      }
    })
  }

  //  Updates account information on selected account change
  $('#accounts').change(function(e) {
    num = $('#accounts').val();
    getAccountInfo();
  });

  //  Pass args to filterSearch
  $('#transactionsForm').submit(function(e) {
    e.preventDefault();
    filterTransactions()
  });

  $('#budgetForm').submit(function(e) {
    e.preventDefault();
    filterBudget();
  });

  //  Populate account list initially
  getAccounts();




});
