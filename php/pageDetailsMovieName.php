<?php include '../admin/includes/connection.php' ?>
<?php include '../admin/includes/connection.php' ?>
<?php

  $movieName = $_GET['movieName'];

  $json = array();
  $result = mysqli_query($connect, "SELECT * FROM movies WHERE movie_title ='" . $movieName ."'");

  while($row = mysqli_fetch_array($result))
  {
    $bus = array(
      'movie_title' => $row['movie_title'],
      'moviedb_id' => $row['moviedb_id'],
      'overview' => $row['overview'],
      'director' => $row['director'],
      'cast' => $row['cast'],
      'poster_path' => $row['poster_path'],
      'poster2_path' => $row['poster2_path'],
      'backdrop_path' => $row['backdrop_path'],
      'backdrop2_path' => $row['backdrop2_path'],
      'backdrop3_path' => $row['backdrop3_path'],
      'score' => $row['score'],
      'review' => $row['review'],
      'release_date' => $row['release_date'],
      'publish_date' => $row['publish_date'],
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
