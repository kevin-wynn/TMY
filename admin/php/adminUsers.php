<?php include '../includes/connection.php' ?>
<?php
  
  connect();

  $json = array();
  $result = mysql_query("SELECT * FROM users ORDER BY user_id ASC");

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
      'l_name' => $row['l_name']
    );
    array_push($json, $bus);
  }

  $jsonstring = json_encode($json);
  echo $jsonstring;

  die();
?>