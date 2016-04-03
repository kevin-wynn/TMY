<?php include '../includes/connection.php' ?>
<?php
  
  connect();

  $movieId = $_GET['movieId'];

  $json = array();
  $result = mysql_query("SELECT * FROM movies WHERE moviedb_id=".$movieId."");

  while($row = mysql_fetch_array($result))
  {
    $bus = array(
      'moviedb_id' => $row['moviedb_id']
    );
    array_push($json, $bus);
  }

  $jsonstring = json_encode($json);
  echo $jsonstring;

  die();
?>