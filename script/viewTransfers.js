$(document).ready(function() {

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

});
