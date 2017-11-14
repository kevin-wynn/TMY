<?php include '../admin/includes/connection.php' ?>
<?php include '../admin/includes/utf.php' ?>
<?php

  $limit = $_GET['limit'];
  $offset = $_GET['offset'];
  $category = $_GET['category'];

  $count = mysqli_query($connect, "SELECT * FROM movies");
  $num_rows = mysqli_num_rows($count);

  $json = array();
  $result = mysqli_query($connect, "SELECT * FROM movies WHERE genre LIKE '%$category%' ORDER BY DATE(publish_date) DESC, publish_date DESC LIMIT $limit OFFSET $offset");

  while($row = mysqli_fetch_array($result))
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
      'total' => $num_rows
    );
    array_push($json, $bus);
  }

  echo json_encode(utf8ize($json));

  die();
?>
