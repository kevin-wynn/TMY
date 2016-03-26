<?php include '../includes/connection.php' ?>
<?php
  session_start();
  connect();

  $login = $_GET["login"];

  $query = mysql_query("UPDATE users SET last_login='" . $login . "' WHERE user_id=" . $_SESSION['user_id'] . "");

  $run = mysql_query($query) or die(mysql_error());

  echo 'last login updated to: '.$login;
?>