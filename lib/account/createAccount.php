<?php
    session_start();


        $valid = true;
        //Get variables from the form on NewAccount
        $accnum = $_POST['accNum'];
        $acctype = $_POST['accType'];
        $balance = $_POST['balance'];
        $instnum = $_POST['instNum'];

        if (!isset($accnum,$acctype,$instnum,$balance)){
            echo "Please complete all fields.";
            echo "<br>";
            $valid = false;
        }

        //ceil(log10($number)) is the number's length
        //Checking that the account number is at least 5 characters long
        if (ceil(log10($accnum)) < 5){
            echo "Account number is not long enough";
            echo "<br>";
            $valid = false;
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

        unset($sql);
        //Checking entered info vs database info
        if (empty($rst)){
            echo "The institution number you have entered is invalid.";
            echo "<br>";
            $valid = false;
        }
        //Checking for if the entered account number is already in the database
        $sql = $con->prepare("SELECT accNum, instNum FROM account");
        $sql->bind_result($hashacc, $instNum);
        $sql->execute();

        while($sql->fetch()) {
          if(password_verify($accnum, $hashacc) && strcmp(strval(intval($instnum)), $instNum)) {
            echo "This account already exists";
            $valid = false;
          }
        }

        unset($sql);
        unset($rst);
        //Adding the entered account to the database linked to the logged in account
        if ($valid){
            $sql = $con->prepare("INSERT INTO account (accNum, accType, balance, instNum, ownerId, lastdigs) VALUES (?, ?, ?, ?, ?, ?)");
            $lastdigs = substr($accnum, strlen($accnum)-3);
            $hash = md5($accnum);
            $sql->bind_param('sidsii',$hash, $acctype, $balance, $instnum, $_SESSION['userId'], $lastdigs);

            if($sql->execute())
              echo "Your account has been updated";
            else
              echo "This account already exists";

              $sql->close();
              $con->close();
        }



?>
