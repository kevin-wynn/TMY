<?php include '../includes/connection.php' ?>
<?php
  connect();

  $discoveryId = $_POST[discoveryId];

  $setfeatured = "UPDATE discovery SET featured = '1' WHERE discovery_id = " . $discoveryId . "";
  $run = mysql_query($setfeatured) or die(mysql_error());

  echo 'sweet';
?>