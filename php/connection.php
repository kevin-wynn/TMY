<?php
  function connect() {
    
      include 'credentials.php';
        
      // connect to database based on submitted user/pass
      $connect = mysql_connect($dbhost, $dbuser, $dbpass);
         if(! $connect )
         {
           die('Could not connect: ' . mysql_error());
         }
    
      // select tmydb
      mysql_select_db($dbname);

      return $connect;
    }
?>