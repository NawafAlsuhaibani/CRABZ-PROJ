<?php
//setting header to json
header('Content-Type: application/json');
//database
$host     = "localhost";
$database = "test";
$user     = "root";
$password = "";
//get connection
$mysqli   = mysqli_connect($host, $user, $password, $database);
if (!$mysqli) {
    die("Connection failed: " . $mysqli->error);
}
//query to get data from the table
$query  = sprintf("SELECT `dateNtime` , `amountCost` as total from cvsfileimport;");
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