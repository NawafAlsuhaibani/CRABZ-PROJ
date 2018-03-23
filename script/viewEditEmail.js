function checkPassword(pass) {
  $.ajax({
    type: 'post',
    url: '../lib/account/checkPassword.php',
    data: {pass:pass},
    success: function(data) {
      if(data === 'true')
        changeEmail($('input[name=email]').val());
      else
        alert("Password does not match");
    }
  })
}

function changeEmail(email) {
  $.ajax({
    type: 'post',
    url: '../lib/account/changeEmail.php',
    data: {email:email},
    success: function(data) {
      alert(data);
    }
  })
}

$(document).ready(function() {

  $('#changeEmailForm').submit(function(e) {
    e.preventDefault();
    checkPassword($('input[name=password]').val());
    $('input[name=email]').val("");
    $('input[name=password]').val("");
  });

});
