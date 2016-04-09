<?php include '../admin/includes/connection.php' ?>
<?php
  
  connect();

  $limit = $_GET['limit'];
  $offset = $_GET['offset'];

  $count = mysql_query("SELECT * FROM movies");
  $num_rows = mysql_num_rows($count);

  $json = array();
  $result = mysql_query("SELECT * FROM movies ORDER BY DATE(publish_date) DESC, publish_date ASC LIMIT $limit OFFSET $offset");

  while($row = mysql_fetch_array($result))     
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
      'published_date' => $row['published_date'],
      'popular_vote' => $row['popular_vote'],
      'genre' => $row['genre'],
      'total' => $num_rows
    );
    array_push($json, $bus);
  }

  $jsonstring = json_encode($json);
  echo $jsonstring;

  die();
?>