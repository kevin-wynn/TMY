<?php
  function connect() {

      include 'credentials.php';

      // connect to database based on submitted user/pass
      $connect = mysqli_connect($dbhost, $dbuser, $dbpass);
         if(! $connect )
         {
           die('Could not connect: ' . mysqli_error());
         }

      // select tmydb
      mysqli_select_db($dbname);

      return $connect;
    }
?>
