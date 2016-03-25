<?php include '../includes/connection.php' ?>
<?php
  connect();

  $id = $_POST[id];

  $reset = "UPDATE movies SET featured = null WHERE featured = '1' AND !isnull( featured );";
  $run = mysql_query($reset) or die(mysql_error());

  $setfeatured = "UPDATE movies SET featured = '1' WHERE movie_id = " . $id . "";
  $run = mysql_query($setfeatured) or die(mysql_error());

  echo 'sweet';
?>