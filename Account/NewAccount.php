<?php
    session_start();
    $_SESSION['userId'] = 1;

    if (isset($_POST['submit'])){
        $valid = TRUE;
        //Get variables from the form on NewAccount
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

        $sql->close();
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

        $sql->close();
        unset($rst);
        //Checking entered info vs database info
        if (!empty($rst)){
            echo "The entered account number is already linked to an account";
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

    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <script type="text/javascript">
        function validateForm(){
            var accnum = document.forms["NewAccount"]["accnum"].value;
            var balance = document.forms["NewAccount"]["balance"].value;
                if (accnum.length != 7){
                    alert("Account number must be 7 digits long");
                    return false;
                }else if(balance <=0){
                    alert("Balance must be greater than 0");
                    return false;
                }else if()

        }
    </script>
</head>
<h1>New Account</h1>
<body>
<form name="NewAccount" action="NewAccount.php" onsubmit="return validateForm()"method="post">

    Account Number: <br>
    <input type="number" name = "accnum" maxlength="12" required> <br>
    Account Type: <br>
    <input type="radio" name="acctype" value=0 required> Chequing
    <input type="radio" name="acctype" value=1 required> Savings <br>
    Balance: <br>
    <input type="number" step="0.01" name="balance" required> <br>
    Institution Number: <br>
    <input type="number" name ="instnum" required> <br>
    <input type="submit" value="submit" name="submit">

</form>
<a href = "Account.php">Back to Account</a>
</body>
</html>

<?php
$sql->close();
$con->close();
?>
