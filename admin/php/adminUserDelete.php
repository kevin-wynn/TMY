<?php include '../includes/connection.php' ?>
<?php
  
  connect();

  $user = $_GET['user'];

  echo $user;

  $query = "DELETE FROM users WHERE user_id =".$user." LIMIT 1";

  $run = mysql_query($query) or die(mysql_error());

  echo 'User Deleted';
?>