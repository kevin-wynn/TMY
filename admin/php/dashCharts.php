<?php include '../includes/connection.php' ?>
<?php
  
  connect();

  $json = array();
  $result = mysql_query("SELECT DATE_FORMAT(publish_date, '%Y-%m-%d') AS 'publish_date' FROM movies");

  while($row = mysql_fetch_array($result))
  {
    $bus = array(
      'publish_date' => $row['publish_date']
    );
    array_push($json, $bus);
  }

  $result2 = mysql_query("SELECT DATE_FORMAT(signup_date, '%Y-%m-%d') AS 'signup_date' FROM users");

  while($row = mysql_fetch_array($result2))
  {
    $bus = array(
      'signup_date' => $row['signup_date']
    );
    array_push($json, $bus);
  }

  $jsonstring = json_encode($json);
  echo $jsonstring;

  die();
?>