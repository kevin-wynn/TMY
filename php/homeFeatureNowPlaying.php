<?php include '../admin/includes/connection.php' ?>
<?php include '../admin/includes/utf.php' ?>
<?php

  $json = array();
  $result = mysqli_query($connect, "SELECT * FROM nowplaying WHERE view_on_home=1 LIMIT 1");

  while($row = mysqli_fetch_array($result))
  {
    $bus = array(
      'movie_title' => $row['movie_title'],
      'overview' => $row['overview'],
      'director' => $row['director'],
      'cast' => $row['cast'],
      'poster_path' => $row['poster_path'],
      'backdrop_path' => $row['backdrop_path'],
      'release_date' => $row['release_date'],
      'popular_vote' => $row['popular_vote'],
      'genre' => $row['genre'],
      'moviedb_id' => $row['moviedb_id']
    );
    array_push($json, $bus);
  }

  echo json_encode(utf8ize($json));

  die();
?>
