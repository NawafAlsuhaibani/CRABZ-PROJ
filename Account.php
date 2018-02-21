<?php
    session_start();
    $_SESSION['userId'] = 1;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CRABZ-Account page</title>

</head>
<?php

$con = new mysqli("localhost", "crabz", "88yGu2XF", "crabz");

if (mysqli_connect_errno()){
    echo "Failed to connect to MySQL: " . mysql_connect_error();
}

$sql = $con->prepare("SELECT name, userName, email FROM user WHERE userId = ?");

$sql->bind_param("i", $_SESSION['userId']);

$sql->execute();

$sql->bind_result($name, $username, $email);

$sql->fetch();


?>
<body>
<h1>Account Information</h1>
<table>
    <tr>
        <td>Name: </td>
        <td><?php echo $name ?></td>
    </tr>

    <tr>
        <td>Username: </td>
        <td><?php echo $username ?></td>
    </tr>

    <tr>
        <td>Email: </td>
        <td><?php echo $email ?></td>
    </tr>

</table>
<a href = "NewAccount.php">New Account</a>
<?php
/**
 * Created by PhpStorm.
 * User: Mike Brehl
 * Date: 2018-02-16
 * Time: 2:55 PM
 */



?>
</body>
</html>

