<?php
  //  Start the session
  session_start();

  require('../db_credentials.php');

  //  Get DB con
  $con = connect();

    // Check for password
    $sql = "SELECT password FROM user WHERE userId = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param('i', $_SESSION['userId']);
    $stmt->execute();
    $stmt->bind_result($hash);
    //  If match found
    if($stmt->fetch()) {

      if(password_verify($_POST['pass'], $hash))
        echo "true";
      else
        echo "false";
    }

    $stmt->close();
    $con->close();

?>
