<?php

$valid = TRUE;
$uname = $_REQUEST['uname'];
$pwd = $_REQUEST['psw'];
if (!isset($uname,$pwd)){
    echo "Please complete all fields.";
    echo "<br>";
    $valid = FALSE;
}
//ceil(log10($number)) is the number's length

$con = mysqli_connect("localhost", "crabz", "88yGu2XF", "crabz");
if (mysqli_connect_errno()){
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
$sql = ("SELECT userName,password FROM user WHERE userName=".$uname." AND password=".$pwd);
$rst = $con->query($sql);
$row = mysqli_fetch_array($rst, MYSQLI_ASSOC) ;

if(mysqli_num_rows($rst) ==0 ){
    echo "not there";
}else{
	echo "loged in succesfully";
}
$sql->close();
$con->close();

?>