<?php include 'php/connection.php' ?>
<?php

  connect();

  $movie = mysql_real_escape_string($_GET['movie_title']);
  $movie = str_replace('-', ' ', $movie);
  
  //Remove LIMIT 1 to show/do this to all results.
  $query = "SELECT * FROM movies WHERE movie_title = '" . $movie . "' LIMIT 1";
  $result = mysql_query($query);
  $row = mysql_fetch_array($result);

  // Echo page content
  echo $row['movie_title'] . '<br>';
  echo $row['overview'] . '<br>';
  echo $row['director'] . '<br>';
  echo $row['cast'] . '<br>';
  echo $row['poster_path'] . '<br>';
  echo $row['backdrop_path'] . '<br>';
  echo $row['score'] . '<br>';
  echo $row['review'] . '<br>';
  echo $row['release_date'] . '<br>';
  echo $row['published_date'] . '<br>';
  echo $row['popular_vote'] . '<br>';
  echo $row['genre'] . '<br>';
?>