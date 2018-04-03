<?php

  /**
  * Get a DB connection
  * @return $con A mysqli DB connection
  */
  function connect() {
    // Connection variables
    $hostName = 'localhost';
    $userName = 'crabz';
    $password = '88yGu2XF';
    $db_name = 'crabz';

    //  Get DB connection
    $con = mysqli_connect("localhost","crabz","88yGu2XF","crabz");
    //  Check if DB con is valid
    if (mysqli_connect_errno())
    {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }

    //  Return the connection
    return $con;
  }
function PDOconnect() {
    // Connection variables
define('DB_HOST' , 	'localhost');
define('DBNAME' , 'crabz');
define('DBUSER' , 'crabz');
define('DBPASS' , '88yGu2XF');
try {
$conn = new PDO("mysql:host=localhost; dbname=".DBNAME."" , DBUSER, DBPASS);
	return $conn;
	}
catch(PDOException $e) {
	die("error" . $e);
}
  }

?>
