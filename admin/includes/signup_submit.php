<?php
  session_start();

  if(!isset( $_POST['username'], $_POST['password'], $_POST['form_token'])) {
      $message = 'Please enter a valid username and password';
  } elseif( $_POST['form_token'] != $_SESSION['form_token']) {
      $message = 'Invalid form submission';
  } elseif (strlen( $_POST['username']) > 20 || strlen($_POST['username']) < 4) {
      $message = 'Incorrect Length for Username';
  } elseif (strlen( $_POST['password']) > 20 || strlen($_POST['password']) < 4) {
      $message = 'Incorrect Length for Password';
  } elseif (ctype_alnum($_POST['username']) != true) {
      $message = "Username must be alpha numeric";
  } elseif (ctype_alnum($_POST['password']) != true) {
          $message = "Password must be alpha numeric";
  } else {
    $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
  
    $password = sha1( $password );

  try {
        include 'credentials.php';
          
        $dbh = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $dbh->prepare("INSERT INTO users (username, password ) VALUES (:username, :password )");
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->bindParam(':password', $password, PDO::PARAM_STR, 40);
        $stmt->execute();

        unset( $_SESSION['form_token'] );
        $message = 'You signed up, bet you feel cool. Now log in...';
    }
    catch(Exception $e) {
        if( $e->getCode() == 23000) {
            $message = 'Username already exists';
        } else {
            $message = 'We are unable to process your request. Please try again later"';
        }
    }
  }
?>
<html>
<?php include 'head.php'; ?>
<title>TMY Admin Page</title>
<body>
  <div id="wrapper">
    <div class="login">
      <p><?php echo $message; ?></p>
      <form class="login-form" action="login_submit.php" method="post">
        <fieldset>
          <p>Username
            <input class="tmy-input login-input" type="text" id="username" name="username" value="" maxlength="20" />
          </p>
          <p>Password
            <input class="tmy-input login-input" type="text" id="password" name="password" value="" maxlength="20" />
          </p>
          <p>
            <input class="login-submit" type="submit" value="Log In" />
          </p>
        </fieldset>
      </form>
    </div>
  </div>
</body>
<?php include 'footer.php'; ?>
</html>