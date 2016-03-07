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
            <div class="col-lg-12 recent">
              <h1>Dashboard</h1>
               <div class="col-md-3">
                 <h4>Database Tools:</h4>
                <form class="server-reset" action="<?php echo dirname($_SERVER['PHP_SELF']);?>/includes/db_reset.php" method="post">
                  <input class="btn button-primary" type="submit" value="Reset Movies Table">
                </form>
                <form class="server-reset" action="<?php echo dirname($_SERVER['PHP_SELF']);?>/includes/users_reset.php" method="post">
                  <input class="btn button-primary" type="submit" value="Clear All Users">
                </form>
              </div>
              <div class="col-md-5" id="users">
                <h4>Users:</h4>
              </div>
              <div class="col-md-4" id="recentMovies">
                <h4>Recently Added Movie:</h4>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- /#page-content-wrapper -->
      <?php } else {
        header('Location: ' . dirname($_SERVER['PHP_SELF']) . '/login.php');
      } ?>
    </div>
    <!-- /#wrapper -->
</body>
<?php include 'includes/footer.php'; ?>
<script src="<?php echo dirname($_SERVER['PHP_SELF']);?>/js/adminHome.js"></script>
</html>