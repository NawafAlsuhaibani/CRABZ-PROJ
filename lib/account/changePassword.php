<?php

  session_start();

  require('../db_credentials.php');
  $con = connect();
  $sql = "UPDATE user SET password = ? WHERE userId = ?";
  $stmt = $con->prepare($sql);
  $hash = md5($_POST['pass']);
  $stmt->bind_param('si',$hash,$_SESSION['userId']);

  if($stmt->execute())
    echo "Password changed";
  else
    echo "Could not change password";

  $stmt->close();
  $con->close();

?>
