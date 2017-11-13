<?php include '../includes/connection.php' ?>
<?php include '../includes/utf.php' ?>
<?php

  $limit = $_GET['limit'];
  $offset = $_GET['offset'];

  $count = mysqli_query($connect, "SELECT * FROM discovery");
  $num_rows = mysqli_num_rows($count);

  $json = array();
  $result = mysqli_query($connect, "SELECT * FROM discovery LIMIT $limit OFFSET $offset");

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
      'featured' => $row['featured'],
      'total' => $num_rows
    );
    array_push($json, $bus);
  }

  echo json_encode(utf8ize($json));

  die();
?>
