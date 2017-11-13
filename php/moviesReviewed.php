<?php include '../admin/includes/connection.php' ?>
<?php include '../admin/includes/utf.php' ?>
<?php

  $count = mysqli_query($connect, "SELECT * FROM movies");

  $num_rows = mysqli_num_rows($count);

  $limit = $_GET['limit'];
  $offset = $_GET['offset'];

  $json = array();
  $result = mysqli_query($connect, "SELECT * FROM movies WHERE featured=false ORDER BY DATE(publish_date) DESC, publish_date DESC LIMIT $limit OFFSET $offset");

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
      'publish_date' => $row['publish_date'],
      'popular_vote' => $row['popular_vote'],
      'genre' => $row['genre'],
      'total' => $num_rows
    );
    array_push($json, $bus);
  }

  echo json_encode(utf8ize($json));

  die();
?>
