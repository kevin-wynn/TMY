<?php include '../admin/includes/connection.php' ?>
<?php
  
  connect();

  //Remove LIMIT 1 to show/do this to all results.
  $query = "SELECT * FROM movies WHERE movie_title = '" . $movie . "' LIMIT 1";
  $result = mysql_query($query);

  while($row = mysql_fetch_array($result))     
  {
    $bus = array(
      'movie_title' => $row['movie_title'],
      'overview' => $row['overview'],
      'director' => $row['director'],
      'cast' => $row['cast'],
      'poster_path' => $row['poster_path'],
      'backdrop_path' => $row['backdrop_path'],
      'score' => $row['score'],
      'review' => $row['review'],
      'release_date' => $row['release_date'],
      'published_date' => $row['published_date'],
      'popular_vote' => $row['popular_vote'],
      'genre' => $row['genre'],
      'featured' => $row['featured']
    );
    array_push($json, $bus);
  }

  $jsonstring = json_encode($json);
  echo $jsonstring;

  die();
?>