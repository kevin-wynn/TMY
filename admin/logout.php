<?php
// Begin the session
session_start();

// Unset all of the session variables.
session_unset();

// Destroy the session.
session_destroy();
?>
<html>
  <head>
    <?php include 'includes/head.php'; ?>
    <title>Logged Out</title>
  </head>
  <body>
   <?php include 'includes/sidebar.php'; ?>
   <div id="wrapper">
     <div class="login">
     <p>You have logged out successfully</p>
     <p>So log back in jackass...</p>
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
     </div>
    </div>
  </body>
  <?php include 'includes/footer.php'; ?>
</html>