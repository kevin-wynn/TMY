<?php include '../includes/connection.php' ?>
<?php
  
  connect();

  $json = array();
  $result = mysql_query("SELECT * FROM discovery");

  while($row = mysql_fetch_array($result))     
  {
    $bus = array(
      'discovery_id' => $row['discovery_id'],
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

  $jsonstring = json_encode($json);
  echo $jsonstring;

  die();
?>