<html>
  <head>
    <?php include 'includes/head.php'; ?>'
    <title>Log In</title>
  </head>
  <body>
  
  <div class="container-fluid navbar">
    <div class="col-md-3 logo">
      <h1><a href="<?php echo dirname($_SERVER['PHP_SELF']);?>/../">TMY</a></h1>
    </div>
  </div>  
  <div class="overlay"></div>
  <div id="bannerContainer"></div>
  
   <div id="login-container">
     <div class="col-md-8 col-md-offset-2 login-only">
       <div class="center-form">
       <h1 class="form-header">Log in</h1>
        <form class="login-form" action="includes/login_submit.php" method="post">
            <p class="form-label">Username</p>
            <input class="tmy-input login-input" type="text" id="username" name="username" value="" maxlength="20" />
            <p class="form-label">Password</p>
            <input class="tmy-input login-input" type="text" id="password" name="password" value="" maxlength="20" />
            <div class="login-signup">
              <input class="login-submit" type="submit" value="Log In" />
              <p><a href="signup.php">I forgot my password</a> | <a href="signup.php">Sign Up</a></p>
            </div>
        </form>
       </div>
     </div>
    </div>
  </body>
  <?php include 'includes/footer.php'; ?>
  <script src="<?php echo dirname($_SERVER['PHP_SELF']);?>/js/loginBackground.js"></script>
</html>