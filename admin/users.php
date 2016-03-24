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
            <div class="container-fluid users-header">
              <h1>Users</h1> <i class="fa fa-plus-circle add-user"></i>
            </div>
            <div class="container-fluid list-users">
             <div class="col-md-12">
                <div class="row nohover">
                  <div class="col-md-1 header">Edit</div>
                  <div class="col-md-1 header">First</div>
                  <div class="col-md-1 header">Last</div>
                  <div class="col-md-1 header">ID</div>
                  <div class="col-md-3 header">Username/Email</div>
                  <div class="col-md-2 header">URL</div>
                  <div class="col-md-1 header">Level</div>
                  <div class="col-md-1 header">Login</div>
                  <div class="col-md-1 header">Signup</div>
                </div>
             </div>
              <div class="col-md-12" id="usersContainer">
                <h5>Users:</h5>
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
    
    <div class="modal fade" tabindex="-1" role="dialog" id="alert">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close close-modal" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title"></h4>
          </div>
          <div class="modal-body">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default cancel-button pull-left" style="display:none;" data-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-default submit-modal" data-dismiss="modal">Okay</button>
          </div>
        </div>
      </div>
    </div>
    
</body>
<?php include 'includes/footer.php'; ?>
<script src="<?php echo dirname($_SERVER['PHP_SELF']);?>/js/users.js"></script>
</html>