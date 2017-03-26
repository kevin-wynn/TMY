<?php include '../includes/connection.php' ?>
<?php

  connect();

  $json = array();
  $count = mysql_query("SELECT COUNT(*) AS 'movies' FROM movies");
  while($row = mysql_fetch_array($count))
  {
    $bus = array(
      'movies' => $row['movies']
    );
    array_push($json, $bus);
  }

  $count2 = mysql_query("SELECT COUNT(*) AS 'recent_movies' FROM movies WHERE publish_date > DATE_SUB(CURDATE(), INTERVAL 1 WEEK)");
  while($row = mysql_fetch_array($count2))
  {
    $bus = array(
      'recent_movies' => $row['recent_movies']
    );
    array_push($json, $bus);
  }

  $count3 = mysql_query("SELECT COUNT(*) AS 'users' FROM users");
  while($row = mysql_fetch_array($count3))
  {
    $bus = array(
      'users' => $row['users']
    );
    array_push($json, $bus);
  }

  $count4 = mysql_query("SELECT COUNT(*) AS 'last_login' FROM users WHERE last_login > DATE_SUB(CURDATE(), INTERVAL 1 WEEK)");
  while($row = mysql_fetch_array($count4))
  {
    $bus = array(
      'last_login' => $row['last_login']
    );
    array_push($json, $bus);
  }
  $jsonstring = json_encode($json);
  echo $jsonstring;

  die();
?>
