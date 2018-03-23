function createAccount(accNum, instNum, balance, accType) {
  $.ajax({
    type: 'post',
    url:  '../lib/account/createAccount.php',
    data: {accNum: accNum, instNum: instNum, balance: balance, accType: accType},
    success: function(data) {
      alert(data);
    },
    error: function(xhr, status, err) {
      alert(status);
      alert(err);
    }
  })
}

$(document).ready(function() {

  // Listen for form submission
  $('#createAccForm').submit(function(e) {
    e.preventDefault();
    var accNum = $('#accNum').val();
    var accType = $('input[name=acctype]:checked').val();
    var instNum = $('#instNum').val();
    var balance = $('#balance').val();
    //alert(instNum);
    // Limit accnum to 8 digits **Arbitrary choice**
    if(accNum.toString().length > 8) {
      alert("Please enter a 8 digit numeric Account Number.");
    }
    else {
      //alert(accType);
      createAccount(accNum, instNum, balance, accType);
    }
  })

});
