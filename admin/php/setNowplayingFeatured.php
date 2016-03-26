<?php include '../includes/connection.php' ?>
<?php
  connect();

  $nowplayingId = $_POST[nowplayingId];

  $setfeatured = "UPDATE nowplaying SET featured = '1' WHERE nowplaying_id = " . $nowplayingId . "";
  $run = mysql_query($setfeatured) or die(mysql_error());

  echo 'sweet';
?>