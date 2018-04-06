<?php

    session_start();

    require('../db_credentials.php');
    $con = connect();
    $sql = "UPDATE user SET email = ? WHERE userId = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param('si',$_POST['email'],$_SESSION['userId']);

    if($stmt->execute()) {
      echo "Email changed";
    }
    else
      echo "Email could not be changed";

    $stmt->close();
    $con->close();

?>
