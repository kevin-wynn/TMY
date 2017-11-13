<?php include '../includes/connection.php' ?>
<?php
  session_start();

  $login = $_GET["login"];

  $query = "UPDATE users SET last_login='" . $login . "' WHERE user_id=" . $_SESSION['user_id'] . "";

  $run = mysqli_query($connect, $query) or die(mysqli_error());

  echo 'last login updated to: '.$login;
?>
