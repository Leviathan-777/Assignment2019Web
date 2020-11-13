<?php
   $dbConn = new mysqli('localhost', 'unn_w18030605', '-------', 'unn_w18030605'); #Connect to the database

   if ($dbConn->connect_error) {
      echo "<p>Connection failed: ".$dbConn->connect_error."</p>\n"; #Show the error message if there is a problem with connecting
      exit;
   }
?>