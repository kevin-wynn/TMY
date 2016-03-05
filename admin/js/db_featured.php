<?php
  include 'connection.php';

  connect();

  $movieTitle = $_POST[movie_title];

  // this clears entire database
  $reset = "UPDATE movies SET featured = null WHERE featured = '1' AND !isnull( featured );";
  $run = mysql_query($reset) or die(mysql_error());

  $setfeatured = "UPDATE movies SET featured = '1' WHERE movie_title = '" . $movieTitle . "'";
  $run = mysql_query($setfeatured) or die(mysql_error());

  echo "<h1>New Featured Movie Set</h1>";
?>