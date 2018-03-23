<?php

  session_start();

  //Connecting to database
  require('../db_credentials.php');
  $con = connect();

  if (mysqli_connect_errno()){
      echo "Failed to connect to MySQL: " . mysql_connect_error();
  }
  //Querying the database for the user's information
  $stmt = $con->prepare("SELECT name, userName, email FROM user WHERE userId = ?");

  $stmt->bind_param("d", $_SESSION['userId']);

  $stmt->execute();

  $stmt->bind_result($name, $username, $email);

  //  If there is a result
  $stmt->fetch();

    //  Build an output str to parse with JS controller
    //  [$name, $username, $email]
    $result = "";
    $result = "$name, $username, $email";

    //  Echo $str arr to JS controller
    echo $result;



  //  Close db connection
  $stmt->close();
  $con->close();

?>
