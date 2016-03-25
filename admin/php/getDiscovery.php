<?php include '../includes/connection.php' ?>
<?php
  
  connect();

  $limit = $_GET['limit'];
  $offset = $_GET['offset'];

  $count = mysql_query("SELECT * FROM discovery");
  $num_rows = mysql_num_rows($count);

  $json = array();
  $result = mysql_query("SELECT * FROM discovery LIMIT $limit OFFSET $offset");

  while($row = mysql_fetch_array($result))     
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

  $jsonstring = json_encode($json);
  echo $jsonstring;

  die();
?>