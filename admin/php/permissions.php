<?php include '../includes/connection.php' ?>
<?php include '../includes/utf.php' ?>
<?php
  session_start();

  $json = array();
  $result = mysqli_query($connect, "SELECT permissions FROM users WHERE user_id = " . $_SESSION['user_id'] . "");

  while($row = mysqli_fetch_array($result))
  {
    $bus = array(
      'permissions' => $row['permissions']
    );
    array_push($json, $bus);
  }

  echo json_encode(utf8ize($json));

  die();
?>
