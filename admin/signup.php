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
       <h1 class="form-header">Enter your email to get started</h1>
        <form class="login-form" id="signupForm" action="includes/signup_submit.php" method="post">
            <p class="form-label">Email</p>
            <input class="tmy-input login-input" type="text" id="email" name="email" value="" maxlength="50" required/>
            <div class="login-signup">
              <input class="login-submit" type="submit" value="Submit" />
              <p>Already a member? <a href="login.php">Login Here</a></p>
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