<?php include '../includes/connection.php' ?>
<?php include '../includes/utf.php' ?>
<?php

  $nowplayingId = $_POST[nowplayingId];

  $setfeatured = "UPDATE nowplaying SET featured = '1' WHERE nowplaying_id = " . $nowplayingId . "";
  $run = mysqli_query($connect, $setfeatured) or die(mysqli_error());

  echo 'sweet';
?>
