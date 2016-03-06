<!DOCTYPE html>
<html>
<?php include 'includes/head.php'; ?>
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
            <div class="container-fluid">
              <h1>Movies</h1>
            </div>
            <div class="container-fluid recent">
              <div class="col-md-12 sort" id="sortMovies">
                <a id="sortAction">Sort Movies <i class="fa fa-sort"></i></a>
                <ul id="sortItems" class="sort-dropdown">
                  <li id="sortReviewed">Recently Reviewed</li>
                  <li id="sortReleased">Recently Released</li>
                </ul>
              </div>
              <div class="col-md-12" id="recentMovies">
              </div>
            </div>
          </div>
        </div>
        <div class="container-fluid">
          <div class="col-md-12 save">
            <form class="server-setup" action="<?php echo dirname($_SERVER['PHP_SELF']);?>/includes/db_featured.php" method="post">
              <input type="hidden" name="movie_title" value="">
              <input class="btn button-primary hidden" name="submit" type="submit" value="Save">
            </form>
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
<script src="<?php echo dirname($_SERVER['PHP_SELF']);?>/js/movies.js"></script>
</html>