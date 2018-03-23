<?php
session_start();
$valid = TRUE;
$userName = $_REQUEST['userName'];
$password = $_REQUEST['password'];
$password2 = $_REQUEST['password2'];
$name = $_REQUEST['name'];
$email = $_REQUEST['email'];
if($password!=$password2){
    echo "Please confirm your passwords";
    echo "<br>";
    $valid = FALSE;
}
if (!isset($userName,$name,$password,$email)){
    echo "Please complete all fields.";
    echo "<br>";
    $valid = FALSE;
}


$con = mysqli_connect("localhost", "crabz", "88yGu2XF", "crabz");
if (mysqli_connect_errno()){
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
$sql = "SELECT userId AS lastId FROM user";
$rst = $con->query($sql);

if($valid){
$sql = $con->prepare("INSERT INTO user (name,userName,password,email) VALUES (?,?,?,?)");
$password = password_hash($password, PASSWORD_DEFAULT);
$sql->bind_param('ssss', $name, $userName, $password, $email);

if (!$sql->execute()) {
        echo $sql->error;
        echo "<br>";
    }
    $stmt = $con->prepare("SELECT userId FROM user WHERE userName = ?");
    $stmt->bind_param("s" , $userName);
    $stmt->execute();
    $stmt->bind_result($uId);
    $stmt->fetch();
    $_SESSION['userId']=$uId;
    header("Location: ../../views/viewAccount.php");
}
$stmt->close();
$sql->close();
$con->close();

?>
