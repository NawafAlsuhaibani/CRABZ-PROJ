<?php

  session_start();

  require_once('../db_credentials.php');

  if(isset($_POST['accNum'])) {
    $sql = "SELECT `paytype` FROM `cvsfileimport` WHERE `accountnum` =? GROUP BY `paytype`;";
	$conn = PDOconnect();
	$str = $_POST['accNum'];		
	$stmt = $conn->prepare($sql);
	$stmt->bindParam(1,$str);
	$stmt->execute();
	if($stmt->rowCount()>'1'){
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		echo json_encode($result);	
	}
  }
$stmt=null;
$conn= null;
?>
