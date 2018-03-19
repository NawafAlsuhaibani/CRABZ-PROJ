<?php

session_start();

$valid = TRUE;
//Get variables from the form on NewAccount
$accnum = $_REQUEST['accnum'];
$acctype = $_REQUEST['acctype'];
$balance = $_REQUEST['balance'];
$instnum = $_REQUEST['instnum'];

//Checking that the user has entered all of the fields
if (!isset($accnum,$acctype,$instnum,$balance)){
    echo "Please complete all fields.";
    echo "<br>";
    $valid = FALSE;
}
//ceil(log10($number)) is the number's length
//Checking that the account number is at least 5 characters long
if (ceil(log10($accnum)) < 5){
    echo "Account number is not long enough";
    echo "<br>";
    $valid = FALSE;
}
//Connecting to database
$con = mysqli_connect("localhost", "crabz", "88yGu2XF", "crabz");

if (mysqli_connect_errno()){
    echo "Failed to connect to MySQL: " . mysql_connect_error();
}
//Checking for if the entered institution number is within the database
$sql = $con->prepare("SELECT instName FROM institution WHERE instNum = ?");
$sql->bind_param('i', $instnum);

$sql->execute();

$sql->bind_result($rst);

$sql->fetch();

unset($sql);
//Checking entered info vs database info
if (empty($rst)){
    echo "The institution number you have entered is invalid.";
    echo "<br>";
    $valid = FALSE;
}
//Checking for if the entered account number is already in the database
$sql = $con->prepare("SELECT accnum FROM account WHERE ownerId = ?");
$sql->bind_param('i',$_SESSION['userId']);

$sql->execute();

$sql->bind_result($rst);

$sql->fetch();

unset($sql);
unset($rst);
//Checking entered info vs database info
if (!empty($rst)){
    echo "The entered account number is already linked to another account";
    echo "<br>";
    $valid = FALSE;
}

//Adding the entered account to the database linked to the logged in account
if ($valid){
    $sql = $con->prepare("INSERT INTO account (accNum, accType, balance, instNum, ownerId) VALUES (?, ?, ?, ?, ?)");
    $sql->bind_param('iidii',$accnum, $acctype, $balance, $instnum, $_SESSION['userId']);

    $sql->execute();
    echo "Your account has been updated";
}

$sql->close();
$con->close();


/**
 * Created by PhpStorm.
 * User: Mike Brehl
 * Date: 2018-02-19
 * Time: 11:49 AM
 */
?>
