<?php
    session_start();
    $_SESSION['admin'] = false;
    if(!isset($_SESSION['userId']))
      header('location: ../views/viewLogin.php');
?>
<?php
//setting header to json
header('Content-Type: application/json');
//database
$host     = "localhost";
$database = "crabz";
$user     = "crabz";
$password = "88yGu2XF";
//get connection
//$mysqli   = new mysqli("localhost", "crabz", "88yGu2XF", "crabz");
$mysqli   = new mysqli("localhost", $user, $password, $user);

if (!$mysqli) {
    die("Connection failed: " . $mysqli->error);
}
if(isset($_GET['mon'])){
	$mon = $_GET['mon'];
	//query to get data from the table
//$query  = sprintf("SELECT amountCost as total, `dateNtime` as month from cvsfileimport where month(`dateNtime`)=$mon and accountnum = ".$_GET['acc']." GROUP BY dateNtime ORDER BY `dateNtime`;");// all year
	$query = "SELECT amountCost as total, DATE_FORMAT(`dateNtime`, '%D') as month from cvsfileimport where month(`dateNtime`)=$mon and accountnum = ".$_GET['acc']." GROUP BY dateNtime ORDER BY `dateNtime`";
//$query  = sprintf("SELECT dateNtime, amountCost as total from cvsfileimport order by dateNtime asc limit 10;");
//execute query

$result = $mysqli->query($query);
//loop through the returned data
$data   = array();
foreach ($result as $row) {
    $data[] = $row;
}
//free memory associated with result
$result->close();
//close connection
$mysqli->close();
//now print the data
print json_encode($data);
}




/* if($_POST["date"]==2){
	$query1 ="";
	if($_POST["month"]==1){
		 $query1 = sprintf("SELECT amountCost as total, `dateNtime` as month from cvsfileimport where month(`dateNtime`)=1 ORDER BY `dateNtime`;"); // for month =1
	}
	else if($_POST["month"]==2){
		 $query1 = sprintf("SELECT amountCost as total, `dateNtime` as month from cvsfileimport where month(`dateNtime`)=2 ORDER BY `dateNtime`;"); // for month =1
	}
	else if($_POST["month"]==3){
		 $query1 = sprintf("SELECT amountCost as total, `dateNtime` as month from cvsfileimport where month(`dateNtime`)=3 ORDER BY `dateNtime`;"); // for month =1
	}
	else if($_POST["month"]==4){
		 $query1 = sprintf("SELECT amountCost as total, `dateNtime` as month from cvsfileimport where month(`dateNtime`)=4 ORDER BY `dateNtime`;"); // for month =1
	}
	else if($_POST["month"]==5){
		 $query1 = sprintf("SELECT amountCost as total, `dateNtime` as month from cvsfileimport where month(`dateNtime`)=5 ORDER BY `dateNtime`;"); // for month =1
	}
	else if($_POST["month"]==6){
		 $query1 = sprintf("SELECT amountCost as total, `dateNtime` as month from cvsfileimport where month(`dateNtime`)=6 ORDER BY `dateNtime`;"); // for month =1
	}
	else if($_POST["month"]==7){
		 $query1 = sprintf("SELECT amountCost as total, `dateNtime` as month from cvsfileimport where month(`dateNtime`)=7 ORDER BY `dateNtime`;"); // for month =1
	}
	else if($_POST["month"]==8){
		 $query1 = sprintf("SELECT amountCost as total, `dateNtime` as month from cvsfileimport where month(`dateNtime`)=8 ORDER BY `dateNtime`;"); // for month =1
	}
	else if($_POST["month"]==9){
		 $query1 = sprintf("SELECT amountCost as total, `dateNtime` as month from cvsfileimport where month(`dateNtime`)=9 ORDER BY `dateNtime`;"); // for month =1
	}
	else if($_POST["month"]==10){
		 $query1 = sprintf("SELECT amountCost as total, `dateNtime` as month from cvsfileimport where month(`dateNtime`)=10 ORDER BY `dateNtime`;"); // for month =1
	}
	else if($_POST["month"]==11){
		 $query1 = sprintf("SELECT amountCost as total, `dateNtime` as month from cvsfileimport where month(`dateNtime`)=11 ORDER BY `dateNtime`;"); // for month =1
	}
	else if($_POST["month"]==12){
		 $query1 = sprintf("SELECT amountCost as total, `dateNtime` as month from cvsfileimport where month(`dateNtime`)=12 ORDER BY `dateNtime`;"); // for month =1
	}
	$result = $mysqli->query($query1);
//loop through the returned data
$data   = array();
foreach ($result as $row) {
    $data[] = $row;
}
//free memory associated with result
$result->close();
//close connection
$mysqli->close();
//now print the data

}*/
