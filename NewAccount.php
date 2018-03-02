<?php
    session_start();
    $_SESSION['userId'] = 1;
?>

<!DOCTYPE html>
<html lang="en">
<h1>New Account</h1>
<form action="AccountConfirm.php" method="post">

    Account Number: <br>
    <input type="number" name = "accnum" maxlength="12" > <br>
    Account Type: <br>
    <input type="radio" name="acctype" value=0> Chequing
    <input type="radio" name="acctype" value=1> Savings <br>
    Balance: <br>
    <input type="number" step="0.01" name="balance"> <br>
    Institution Number: <br>
    <input type="number" name ="instnum"> <br>
    <input type="submit" value="submit">

</form>
</html>
