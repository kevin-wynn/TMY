<?php include '../includes/connection.php' ?>
<?php
  connect();

  $json = array();
  $result = mysql_query("SELECT genre FROM movies");
  while($row = mysql_fetch_array($result))
  {
    $bus = array(
      'genre' => $row['genre']
    );
    array_push($json, $bus);
  }

  $jsonstring = json_encode($json);
  echo $jsonstring;

  die();
?>

select genre from movies where genre like '%drama%';
