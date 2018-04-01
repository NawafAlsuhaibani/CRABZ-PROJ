<?php
   session_start();
   $_SESSION['userId'] = null;
   $_SESSION['admin'] = false;
   unset($_SESSION['userId']);
   unset($_SESSION['admin']);
   unset($_SESSION['loginError']);



   echo 'Logged out succesfully...Redirecting';
   header('Refresh: 2; URL = ../../views/viewLogin.php');
?>
