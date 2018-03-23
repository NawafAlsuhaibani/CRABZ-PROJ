function changePass(pass) {
  $.ajax({
    type: 'post',
    url: '../lib/account/changePassword.php',
    data: {pass:pass},
    success: function(data) {
      alert(data);
      $('input[name=oldpass]').val("");
      $('input[name=newpass1]').val("");
      $('input[name=newpass2]').val("");
    }
  })
}

function checkPassword(pass,pass1) {
  $.ajax({
    type: 'post',
    url: '../lib/account/checkPassword.php',
    data: {pass:pass},
    success: function(data) {
      if(data == 'true')
        changePass(pass1);
      else
        alert("Entered password does not match current password");
    }
  })
}

$(document).ready(function() {

  $('#changePassForm').submit(function(e) {
    e.preventDefault();
    var pass1 = $('input[name=newpass1]').val();
    var pass2 = $('input[name=newpass2]').val();
    var oldPass = $('input[name=oldpass]').val();
    if(pass1 !== pass2) {
      alert("Passwords do not match!");
    }
    else {
      checkPassword(oldPass, pass1);
    }
  })

});
