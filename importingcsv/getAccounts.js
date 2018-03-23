function getAccounts() {
  $.ajax({
    type: 'post',
    url:  '../lib/transactions/getAccounts.php',
    success: function (data) {
      $('#accounts').html(data);
      num = $("#accounts option:first").val();
    }
  })
}

$(document).ready(function() {
  getAccounts();
})
