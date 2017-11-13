<?php include '../includes/connection.php' ?>
<?php include '../includes/utf.php' ?>
<?php

  $discoveryId = $_POST[discoveryId];

  $setfeatured = "UPDATE discovery SET featured = '1' WHERE discovery_id = " . $discoveryId . "";
  $run = mysqli_query($connect, $setfeatured) or die(mysqli_error());

  echo 'sweet';
?>
