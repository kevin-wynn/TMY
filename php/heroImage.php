<?php include '../admin/includes/connection.php' ?>
<?php include '../admin/includes/utf.php' ?>
<?php

  $json = array();
  $result = mysqli_query($connect, "SELECT * FROM movies WHERE featured = '1'");

  while($row = mysqli_fetch_array($result))
  {
    $bus = array(
      'movie_id' => $row['movie_id'],
      'movie_title' => $row['movie_title'],
      'overview' => $row['overview'],
      'director' => $row['director'],
      'cast' => $row['cast'],
      'poster_path' => $row['poster_path'],
      'backdrop_path' => $row['backdrop_path'],
      'score' => $row['score'],
      'review' => $row['review'],
      'release_date' => $row['release_date'],
      'published_date' => $row['publish_date'],
      'popular_vote' => $row['popular_vote'],
      'genre' => $row['genre'],
      'featured' => $row['featured'],
      'trailer' => $row['trailer']
    );
    array_push($json, $bus);
  }

  echo json_encode(utf8ize($json));

  die();
?>
