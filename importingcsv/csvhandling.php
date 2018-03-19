<?php
//require_once ('../connection/config.php');
//$conn = mysqli_connect(DB_HOST, DBUSER, DBPASS, DBNAME);

require('../lib/db_credentials.php');
$con = connect();

$error = mysqli_connect_error();
if ($error != null)
    {
    $output = "<p>Unable to connect to database</p>" . $error;
    exit($output);
    }
?>
<?php
if (isset($_POST['import']))
    {
    $filename = $_FILES["file1"]['tmp_name'];
		$filetype = $_FILES["file1"]["type"];
    if ($_FILES["file1"]["error"] > 0)
        {
        echo "error";
        }
    if ($_FILES["file1"]["size"] > 0)
        {
        $sql = "LOAD DATA LOCAL INFILE '$filename' INTO TABLE cvsfileimport FIELDS TERMINATED BY ',' ";
        if ($conn->query($sql) === TRUE)
            {
            echo "new data inserted $filetype";
            }
          else
            {
            echo "error inserting the data" . "<br />" . $conn->error;
            }
        }
    }
function get_all_record()
    {
    global $conn;
    $sql1 = "select * from cvsfileimport;";
    $result = $conn->query($sql1);
    if ($result->num_rows > 0)
        {
        echo "<table><tr><th>Date</th><th>amount$</th><th>catagory</th>";
        while ($row = $result->fetch_assoc())
            {
            echo "<tr><td> " . $row['dateNtime'] . "</td><td>" . $row['amountCost'] . "</td><td>" . $row['paytype'] . "</td></tr>";
            }
        }
    }
?>
