$(document).ready(function() {

$('#sendFundsBtn').click(function () {
  $('#transferType').html("Transfer Money");
  $('#transferContainer').addClass('hidden');
  $('#transferForm').removeClass('hidden');
});

$('#viewTransfersBtn').click(function () {
  //  Get selected radio button in group
  var radioValue = $("input[name='status']:checked").val();
  //  If null set to default text
  if(!radioValue)
    radioValue = "All Transfers";
  $('#transferType').html(radioValue);
  $('#transferContainer').removeClass('hidden');
  $('#transferForm').addClass('hidden');
});

/* Client side code for switching text -- Using PHP instead
  $('input[name=filter]').click(function () {

    var sort = $('input[name=filter]:checked').val();
    var title = $('#transferType');
    var send_receiv = $('#sender-receiver');

    if(sort == 'Sent') {
      title.html('Sent Transfers');
      send_receiv.html('Receiver');
    }
    else {
      title.html('Received Transfers');
      send_receiv.html('Sender');
    }
  });
*/

});
