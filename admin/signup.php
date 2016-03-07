<?php
  session_start();
  $form_token = md5( uniqid('auth', true) );
  $_SESSION['form_token'] = $form_token;
?>
<html>
  <head>
    <?php include 'includes/head.php'; ?>'
    <title>Sign Up</title>
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
        <form class="login-form" id="signupForm" action="includes/signup_submit.php" method="post">
            <p>Username
              <input class="tmy-input login-input" type="text" id="username" name="username" value="" maxlength="20" required/>
            </p>
            <p>Password
              <input class="tmy-input login-input" type="text" id="password" name="password" value="" maxlength="20" required/>
            </p>
            <p>Confirm Password
              <input class="tmy-input login-input" type="text" id="passwordConfirm" name="passwordConfirm" value="" maxlength="20" required/>
            </p>
            <p>Email
              <input class="tmy-input login-input" type="text" id="email" name="email" value="" maxlength="50" required/>
            </p>
            <div class="login-signup">
              <input type="hidden" name="form_token" value="<?php echo $form_token; ?>" />
              <input class="login-submit" type="submit" value="Create" />
              <p>Or... <a href="login.php">Log In Here</a></p>
            </div>
        </form>
      </div>
     </div>
    </div>
    
</body>
  <?php include 'includes/footer.php'; ?>
  <script src="<?php echo dirname($_SERVER['PHP_SELF']);?>/js/loginBackground.js"></script>
  <script src="<?php echo dirname($_SERVER['PHP_SELF']);?>/js/jquery.validate.min.js"></script>
  <script src="<?php echo dirname($_SERVER['PHP_SELF']);?>/js/signup.js"></script>
</html>