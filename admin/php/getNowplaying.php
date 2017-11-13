<?php include '../includes/connection.php' ?>
<?php include '../includes/utf.php' ?>
<?php

  $json = array();
  $result = mysqli_query($connect, "SELECT * FROM nowplaying");

  while($row = mysqli_fetch_array($result))
  {
    $bus = array(
      'nowplaying_id' => $row['nowplaying_id'],
      'movie_title' => $row['movie_title'],
      'overview' => $row['overview'],
      'director' => $row['director'],
      'cast' => $row['cast'],
      'poster_path' => $row['poster_path'],
      'backdrop_path' => $row['backdrop_path'],
      'release_date' => $row['release_date'],
      'popular_vote' => $row['popular_vote'],
      'genre' => $row['genre'],
      'featured' => $row['featured']
    );
    array_push($json, $bus);
  }

  echo json_encode(utf8ize($json));

  die();
?>
