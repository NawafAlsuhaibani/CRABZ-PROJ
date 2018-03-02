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
//Connecting to database
$con = new mysqli("localhost", "crabz", "88yGu2XF", "crabz");

if (mysqli_connect_errno()){
    echo "Failed to connect to MySQL: " . mysql_connect_error();
}
//Querying the database for the user's information
$sql = $con->prepare("SELECT name, userName, email FROM user WHERE userId = ?");

$sql->bind_param("i", $_SESSION['userId']);

$sql->execute();

$sql->bind_result($name, $username, $email);

$sql->fetch();

//Displaying the user's information
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
<a href = "NewAccount.php">New Account</a> <br>
<a href = "EditEmail.php">Edit Email</a> <br>
<a href = "EditPassword.php">Edit Password</a>
</body>
</html>

