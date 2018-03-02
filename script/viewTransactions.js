$(document).ready(function() {

  $('#showBudget').click(function () {
    $('#TransactionView').addClass('hidden');
    $('#BudgetView').removeClass('hidden');
  });

  $('#showTransactions').click(function () {
    $('#TransactionView').removeClass('hidden');
    $('#BudgetView').addClass('hidden');
  });

});
