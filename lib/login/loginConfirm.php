<?php
session_start();
$_SESSION['userName'] = $_POST['uname'];
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
//$con = mysqli_connect("localhost", "", "", "test");
if (mysqli_connect_errno()){
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
$stmt = $con->prepare("SELECT userId,userName,password FROM user WHERE userName= ? AND password=?");
$stmt->bind_param("ss" , $uname , $pwd);
//$sql = ("SELECT userName,password FROM user WHERE userName=".$uname." AND password=".$pwd);

//$rst = $con->query($sql);
$stmt->execute();
$stmt->bind_result($uId, $uname , $pwd);
$stmt->store_result();
$stmt->fetch();
if($stmt->num_rows==1) {
  $_SESSION['userId']=$uId;

  header("Location: ../../Account/Account.php");

}
else {
	echo "userId or password is not matched";
}
//$row = mysqli_fetch_array($rst, MYSQLI_ASSOC) ;

//if(mysqli_num_rows($rst) ==0 ){
//    echo "not there";
//}else{
	//echo "loged in succesfully";
//}
$stmt->close();
$con->close();

?>