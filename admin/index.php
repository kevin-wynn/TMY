<!DOCTYPE html>
<html>
<?php include 'includes/head.php'; ?>

<?php include 'includes/connection.php'; connect(); ?>

<title>TMY Admin Page</title>
<body>
    <div id="wrapper">

      <?php
        session_start();
        if(!isset($_SESSION['user_id'])) {
          $message = 'You must be logged in to access this page';
        }
        else {
          try {
            include 'credentials.php';
            $dbh = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $dbh->prepare("SELECT username FROM users WHERE user_id = :user_id");
            $stmt->bindParam(':user_id', $_SESSION['user_id'], PDO::PARAM_INT);
            $stmt->execute();
            $username = $stmt->fetchColumn();
          }
          catch (Exception $e) {
            $message = 'We are unable to process your request. Please try again later"';
          }
        }
      ?>
      <?php if($username == true) { ?>
      <?php include 'includes/sidebar.php'; ?>
      <!-- Page Content -->
      <div id="page-content-wrapper">
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-12">
              <h1>Dashboard</h1>
              <div class="col-md-12">
                <form class="server-reset" action="<?php echo dirname($_SERVER['PHP_SELF']);?>/includes/db_reset.php" method="post">
                  <input class="btn button-primary" type="submit" value="Reset Movies Table">
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- /#page-content-wrapper -->
      <?php } else {
        include 'includes/sidebar.php';
        $message = 'You need to be logged in to see this page';
        echo '<div class="login">';
        echo $message;
        ?>
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
      <?php echo '</div>';  } ?>
    </div>
    <!-- /#wrapper -->
</body>
<?php include 'includes/footer.php'; ?>
</html>