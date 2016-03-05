<?php

  include 'connection.php';

  connect();

  // this clears entire database
  $reset = "TRUNCATE TABLE movies";
  $run = mysql_query($reset) or die(mysql_error());

  echo "<h1>Movies tables reset</h1>";
?>