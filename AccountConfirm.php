<?php

session_start();
$_SESSION['userId'] = 1;

$valid = TRUE;

$accnum = $_REQUEST['accnum'];
$acctype = $_REQUEST['acctype'];
$balance = $_REQUEST['balance'];
$instnum = $_REQUEST['instnum'];


if (!isset($accnum,$acctype,$instnum,$balance)){
    echo "Please complete all fields.";
    echo "<br>";
    $valid = FALSE;
}
//ceil(log10($number)) is the number's length
if (ceil(log10($accnum)) < 5){
    echo "Account number is not long enough";
    echo "<br>";
    $valid = FALSE;
}

$con = mysqli_connect("localhost", "crabz", "88yGu2XF", "crabz");

if (mysqli_connect_errno()){
    echo "Failed to connect to MySQL: " . mysql_connect_error();
}
$sql = $con->prepare("SELECT instName FROM institution WHERE instNum = ?");
$sql->bind_param('i', $instnum);

$sql->execute();

$sql->bind_result($rst);

$sql->fetch();

unset($sql);

if (empty($rst)){
    echo "The institution number you have entered is invalid.";
    echo "<br>";
    $valid = FALSE;
    unset($rst);
}

$sql = $con->prepare("SELECT accnum FROM account WHERE ownerId = ?");
$sql->bind_param('i',$_SESSION['userId']);

$sql->execute();

$sql->bind_result($rst);

$sql->fetch();

unset($sql);

if (!empty($rst)){
    echo "The entered account number is already linked to another account";
    echo "<br>";
    $valid = FALSE;
}


if ($valid){
    $sql = $con->prepare("INSERT INTO account (accNum, accType, balance, instNum, ownerId) VALUES (?, ?, ?, ?, ?)");
    $sql->bind_param('iidii',$accnum, $acctype, $balance, $instnum, $_SESSION['userId']);

    if (!$sql->execute()) {
        echo $sql->error;
        echo "<br>";
    }else{
        echo "not fuck";
    }

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