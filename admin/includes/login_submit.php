<?php
  session_start();

  if(isset( $_SESSION['user_id'] )) {
    $message = 'User is already logged in';
  } if(!isset( $_POST['username'], $_POST['password'])) {
    $message = 'Please enter a valid username and password';
  }

  else {
    $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);

    $salt = "69#77234020$20134230942356";

    $password = hash('sha512', $salt.$password);

    try {
        include 'credentials.php';

        $dbh = new PDO("mysql:host=$host_name;dbname=$database", $user_name, $password);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $dbh->prepare("SELECT user_id, username, password FROM users
                    WHERE username = :username AND password = :password");

        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->bindParam(':password', $password, PDO::PARAM_STR);

        $stmt->execute();
        $user_id = $stmt->fetchColumn();
        if($user_id == false) {
          $message = 'Login Failed';
        } else {
          echo $user_id;
          $_SESSION['user_id'] = $user_id;
          $message = 'You logged in, congratulations...';
        }
    }
    catch(Exception $e) {
      $message = 'We are unable to process your request. Please try again later"';
    }

    // header( 'Location: ' . dirname($_SERVER['PHP_SELF']) . '/../' );
  }
?>
