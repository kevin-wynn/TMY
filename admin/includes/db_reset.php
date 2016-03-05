<?php
  // this clears entire database
  $reset = "TRUNCATE TABLE movies";
  $run = mysql_query($reset) or die(mysql_error());
?>