<html>
  <head>
    <?php include 'includes/head.php'; ?>
    <title>Logged Out</title>
  </head>
  <body>
   <div id="wrapper">
     <div class="login">
     <p>Log in fool</p>
      <form class="login-form" action="includes/login_submit.php" method="post">
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
      <form class="login-form" action="signup.php" method="post">
        <p>Or if you don't have an account...</p>
        <p><input class="login-submit" type="submit" value="Sign Up" /></p>
      </form>
     </div>
    </div>
  </body>
  <?php include 'includes/footer.php'; ?>
</html>