<?php
   session_start();
   unset($_SESSION['id']);
   unset($_SESSION["password"]);

   echo 'You have cleaned session';
   header('Refresh: 2; URL = login.php');
?>
