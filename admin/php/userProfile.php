<?php include '../includes/connection.php' ?>
<?php
  
  connect();

  $id = $_GET['id'];

  $json = array();
  $result = mysql_query("SELECT * FROM users WHERE user_id=".$id."");

  while($row = mysql_fetch_array($result))     
  {
    $bus = array(
      'user_id' => $row['user_id'],
      'username' => $row['username'],
      'email' => $row['email'],
      'permissions' => $row['permissions'],
      'last_login' => $row['last_login'],
      'url_slug' => $row['url_slug'],
      'f_name' => $row['f_name'],
      'l_name' => $row['l_name'],
      'headshot' => $row['headshot']
    );
    array_push($json, $bus);
  }

  $jsonstring = json_encode($json);
  echo $jsonstring;

  die();
?>