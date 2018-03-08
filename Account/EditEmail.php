<?php
    session_start();
    $_SESSION['userId'] = 1;
    //If the form has been submitted, this runs to check that everything was submitted correctly
    if(isset($_POST['submit'])){
        //initializing the user's entered emails
        $newmail1 = $_POST['newmail1'];
        $newmail2 = $_POST['newmail2'];

        //Connecting to the database
        $con = mysqli_connect("localhost", "crabz", "88yGu2XF", "crabz");

        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysql_connect_error();
        }
        //getting the previous email from the database
        $sql = $con->prepare("SELECT email FROM user WHERE userId = ?");
        $sql->bind_param('i', $_SESSION['userId']);

        $sql->execute();

        $sql->bind_result($rst);

        $sql->fetch();

        $sql->close();

        //Checks that the user entered an email, that it doesn't match their current email, and it matches the other one they enetered
        if (!empty($newmail1) && $rst != $newmail1 && $newmail1 == $newmail2) {
            echo "Change complete";
            //Setting their new email
            $sql = $con->prepare("UPDATE user SET email = ? WHERE userId = ?");
            $sql->bind_param('si',$newmail1, $_SESSION['userId']);
            $sql->execute();
            //If their emails match but it's the same as their current email
        }elseif ($rst == $newmail1 && $newmail1 == $newmail2){
            echo "You must enter a new email";
        }else{
            echo "Invalid";
        }

    }
?>

<!DOCTYPE html>
<html lang="en">
<h1>Edit Email</h1>
<form action="EditEmail.php" method="post">

    Enter new email: <br>
    <input type="text" name = "newmail1"> <br>
    Confirm new email: <br>
    <input type="text" name = "newmail2"> <br>
    <input type="submit" value ="submit" name="submit"> <br>

</form>
<a href = "Account.php">Back to Account</a>
</html>
<?php
$sql->close();
$con->close();
?>
