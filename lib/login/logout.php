<?php
   session_start();
   unset($_SESSION['userId']);


   echo 'Logged out succesfully';
   header('Refresh: 2; URL = ../../views/viewLogin.php');
?>
