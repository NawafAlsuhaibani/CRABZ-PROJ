/**
* Sets the user info in viewAccount.php
*/
function getUserInfo() {
  $.ajax({
    type: 'post',
    url:  '../lib/account/getUserInfo.php',
    success: function(str) {
      var arr = str.split(',');
      $('#name').html(arr[0]);
      $('#userName').html(arr[1]);
      $('#email').html(arr[2]);
    },
    error: function(xhr, status, err) {
      alert(status);
      alert(err);
    }
  })
}

function getAccounts() {
  $.ajax({
    type: 'post',
    url:  '../lib/account/getAccounts.php',
    success: function(str) {
      //alert(str);
      $('#accounts').append(str);
    },
    error: function(xhr, status, err) {
      alert(status);
      alert(err);
    }
  })
}

$(document).ready(function() {

  getUserInfo();
  getAccounts();

});
