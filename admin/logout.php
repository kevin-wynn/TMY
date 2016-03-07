<?php
  session_start();
  session_unset();
  session_destroy();
?>
<html>
  <head>
    <?php include 'includes/head.php'; ?>'
    <title>Log In</title>
  </head>
  <body>
  
  <div class="container-fluid navbar">
    <div class="col-md-3 logo">
      <h1>TMY</h1>
    </div>
  </div>  
  <div class="overlay"></div>
  <div id="bannerContainer"></div>
  
     <div id="login-container">
     <div class="col-md-8 col-md-offset-2 login-only">
       <div class="center-form">
       <p>You have successfully logged out, was that an accident?</p>
        <form class="login-form" action="includes/login_submit.php" method="post">
            <p>Username
              <input class="tmy-input login-input" type="text" id="username" name="username" value="" maxlength="20" />
            </p>
            <p>Password
              <input class="tmy-input login-input" type="text" id="password" name="password" value="" maxlength="20" />
            </p>
            <div class="login-signup">
              <input class="login-submit" type="submit" value="Log In" />
            </div>
        </form>
       </div>
     </div>
    </div>
  
  </body>
  <?php include 'includes/footer.php'; ?>
  <script src="<?php echo dirname($_SERVER['PHP_SELF']);?>/js/loginBackground.js"></script>
</html>