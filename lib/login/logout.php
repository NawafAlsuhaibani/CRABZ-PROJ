<?php
   session_start();
   $_SESSION['userId'] = null;
   $_SESSION['admin'] = false;
   unset($_SESSION['userId']);
   unset($_SESSION['admin']);



   echo 'Logged out succesfully';
   header('Refresh: 2; URL = ../../views/viewLogin.php');
?>
