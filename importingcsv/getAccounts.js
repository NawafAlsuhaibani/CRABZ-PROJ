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

$(document).ready(function() {
  getAccounts();
})
