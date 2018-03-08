<?php
    session_start();
    $_SESSION['userId'] = 1;
    $_SESSION['admin'] = false;
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

if($_SESSION['admin'] == false):

    //Querying the database for the user's information
    $sql = $con->prepare("SELECT name, userName, email FROM user WHERE userId = ?");

    $sql->bind_param("i", $_SESSION['userId']);

    $sql->execute();

    $sql->bind_result($name, $username, $email);

    $sql->fetch();

    $sql->close();
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

        <tr>
            <td>Accounts:</td>
            <td>
            <?php
            //This whole block of code finds all the accounts of the logged-in user and prints them out for the user to see
            $sql = $con->prepare("SELECT accNum FROM account WHERE ownerId = ?");

            $sql->bind_param("i", $_SESSION['userId']);

            $sql->execute();

            $sql->bind_result($accNum);

            while($sql->fetch()):
            ?>
            <?php echo $accNum ?>
            <br>
            <?php endwhile; ?>
            </td>
        </tr>


    </table>
    <a href = "NewAccount.php">New Account</a> <br>
    <a href = "EditEmail.php">Edit Email</a> <br>
    <a href = "EditPassword.php">Edit Password</a>
    </body>
<?php else:

    //Setting up SQL
    $sql = "SELECT * FROM user";
    //Execute query
    $rst = $con->query($sql);
    //Seek to beginning of results
    $rst->data_seek(0);
    //Get page variables

?>
    <body>
    <h1>User Accounts</h1>
    <table>
        <tr>
            <td>UserId</td>
            <td>Name</td>
            <td>Email</td>
        </tr>
        <?php
        //Looping through the rows of users and printing them out in a table
        while($row = $rst->fetch_assoc()):

        $userid = $row['userId'];
        $username = $row['name'];
        $useremail = $row['email'];
        ?>
        <tr>
            <td><?php echo $userid ?></td>
            <td><?php echo $username ?></td>
            <td><?php echo $useremail ?></td>
        </tr>

        <?php endwhile; ?>
    </table>
    </body>
</html>
<?php
endif;
$sql->close();
$con->close();
?>