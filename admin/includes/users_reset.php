<?php

  include 'connection.php';

  connect();

  // this clears entire database
  $reset = "TRUNCATE TABLE users";
  $run = mysql_query($reset) or die(mysql_error());
  
?>