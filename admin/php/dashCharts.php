<?php include '../includes/connection.php' ?>
<?php include '../includes/utf.php' ?>
<?php

  $json = array();
  $count = mysqli_query($connect, "SELECT COUNT(*) AS 'movies' FROM movies");
  while($row = mysqli_fetch_array($count))
  {
    $bus = array(
      'movies' => $row['movies']
    );
    array_push($json, $bus);
  }

  $count2 = mysqli_query($connect, "SELECT COUNT(*) AS 'recent_movies' FROM movies WHERE publish_date > DATE_SUB(CURDATE(), INTERVAL 1 WEEK)");
  while($row = mysqli_fetch_array($count2))
  {
    $bus = array(
      'recent_movies' => $row['recent_movies']
    );
    array_push($json, $bus);
  }

  $count3 = mysqli_query($connect, "SELECT COUNT(*) AS 'users' FROM users");
  while($row = mysqli_fetch_array($count3))
  {
    $bus = array(
      'users' => $row['users']
    );
    array_push($json, $bus);
  }

  $count4 = mysqli_query($connect, "SELECT COUNT(*) AS 'last_login' FROM users WHERE last_login > DATE_SUB(CURDATE(), INTERVAL 1 WEEK)");
  while($row = mysqli_fetch_array($count4))
  {
    $bus = array(
      'last_login' => $row['last_login']
    );
    array_push($json, $bus);
  }
  
  echo json_encode(utf8ize($json));

  die();
?>
