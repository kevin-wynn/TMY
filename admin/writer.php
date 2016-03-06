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
            <div class="col-lg-12">
              <h1>Writer</h1>
              <div class="search-field">
                <p class="search-label tmy-label">Search for movie:</p> <input id="searchBox" class="search-box tmy-input" type="text" name="search" autofocus>
              </div>

              <div class="col-md-12 results" id="resultsContainer"></div>

              <form class="review" action="<?php echo dirname($_SERVER['PHP_SELF']);?>/includes/submit-review.php" method="post">
                <p>Rating: </p><div class="rating"></div>
                <input class="tmy-input-hidden" type="hidden" name="movie_title">
                <input class="tmy-input-hidden" type="hidden" name="overview">
                <input class="tmy-input-hidden" type="hidden" name="director">
                <input class="tmy-input-hidden" type="hidden" name="cast">
                <input class="tmy-input-hidden" type="hidden" name="poster_path">
                <input class="tmy-input-hidden" type="hidden" name="backdrop_path">
                <input class="tmy-input-hidden" type="hidden" name="release_date">
                <input class="tmy-input-hidden" type="hidden" name="publish_date">
                <input class="tmy-input-hidden" type="hidden" name="published">
                <input class="tmy-input-hidden" type="hidden" name="popular_vote">
                <input class="tmy-input-hidden" type="hidden" name="genre">
                <p>Review: </p>
                <textarea class="editor" name="review"></textarea><br>
                <input class="btn button-primary" type="submit" value="Submit">
              </form>
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
<script src="<?php echo dirname($_SERVER['PHP_SELF']);?>/js/admin.js"></script>
</html>