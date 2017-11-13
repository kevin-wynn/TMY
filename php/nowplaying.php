<?php include '../admin/includes/connection.php' ?>
<?php

  $json = array();
  $result = mysqli_query($connect, "SELECT * FROM nowplaying WHERE featured=1");

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

  $jsonstring = json_encode($json);
  echo $jsonstring;

  die();
?>
