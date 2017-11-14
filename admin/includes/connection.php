<?php
  include 'credentials.php';

  // connect to database based on submitted user/pass
  $connect = mysqli_connect($host_name, $user_name, $password, $database);

     if(! $connect )
     {
       die('Could not connect: ' . mysqli_error($connect));
     }

  // select tmydb
  mysqli_select_db($connect, $database);
?>
