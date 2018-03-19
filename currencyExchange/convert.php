	 <?php
        $fr = $_POST["from"];
        $t = $_POST["to"];
        $am = $_POST["amount"];
          $data = file_get_contents("https://finance.google.com/finance/converter?a=$am&from=$fr&to=$t");
        preg_match("/<span class=bld>(.*)<\/span>/",$data, $converted);
        $converted = preg_replace("/[^0-9.]/", "", $converted[1]);

  echo  $converted;


 ?>
