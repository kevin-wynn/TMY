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
       <h1 class="form-header">Confirm Password</h1>
        <form class="login-form" id="resetForm" action="includes/reset.php" method="post">
            <p class="form-label">Email</p>
            <input class="tmy-input login-input" type="text" id="email" name="email" value="" maxlength="50" required/>
            <p class="form-label">Password</p>
            <input class="tmy-input login-input" type="password" id="password" name="password" value="" required/>
            <p class="form-label">Confirm Password</p>
            <input class="tmy-input login-input" type="password" id="confirmpassword" name="confirmpassword" value="" required/>
            <div class="login-signup">
              <input type="hidden" name="q" value="'<?php
              if (isset($_GET["q"])) {
                echo $_GET["q"];
              } ?>'" />
              <input class="login-submit" name="ResetPasswordForm" type="submit" value="Create" />
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
