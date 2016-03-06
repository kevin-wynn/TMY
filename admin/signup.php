<?php

/*** begin our session ***/
session_start();

/*** set a form token ***/
$form_token = md5( uniqid('auth', true) );

/*** set the session form token ***/
$_SESSION['form_token'] = $form_token;
?>

<!DOCTYPE html>
<html>
<?php include 'includes/head.php'; ?>
<title>TMY Admin Page</title>
<body>
    <div id="wrapper">
      <div class="login">
      <h2>Sign Up</h2>
      <form class="login-form" action="includes/signup_submit.php" method="post">
        <fieldset>
          <p>Username
            <input class="tmy-input" type="text" id="username" name="username" value="" maxlength="20" />
          </p>
          <p>Password
            <input class="tmy-input" type="text" id="password" name="password" value="" maxlength="20" />
          </p>
          <p>
            <input type="hidden" name="form_token" value="<?php echo $form_token; ?>" />
            <input class="login-submit" type="submit" value="Create" />
          </p>
        </fieldset>
      </form>
      <form class="login-form" action="login.php" method="post">
        <p>Or if you have an account...</p>
        <p><input class="login-submit" type="submit" value="Log In" /></p>
      </form>
    </div>
  </div>
</body>
<?php include 'includes/footer.php'; ?>
<script src="<?php echo dirname($_SERVER['PHP_SELF']);?>/js/movies.js"></script>
</html>