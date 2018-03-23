<?php
   session_start();
   $_SESSION['userId'] = null;
   unset($_SESSION['userId']);



   echo 'Logged out succesfully';
   header('Refresh: 2; URL = ../../views/viewLogin.php');
?>
