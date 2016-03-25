<?php include '../includes/connection.php'; ?>

<?php

  connect();

  // clear out table to get fresh list
  $query = "TRUNCATE TABLE discovery";
  $run = mysql_query($query) or die(mysql_error());

  echo 'discovery table cleared';
  
?>