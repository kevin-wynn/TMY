<!DOCTYPE html>
<html>
<?php include 'includes/head.php'; ?>
<title>TMY Admin Page</title>
<body>
    <div id="wrapper">
      <?php if($username == true) { ?>
      <?php include 'includes/sidebar.php'; ?>
      <!-- Page Content -->
      <div id="page-content-wrapper">
        <div class="container-fluid">
          <div class="row">
            <div class="container-fluid user-header">
              <h1 id="profile"></h1>
            </div>
            <div class="container-fluid user-profile">
              <div class="col-md-12" id="profileContainer">
                <div class="col-md-4 headshot-container" id="headshot">
                  <div class="headshot">
                    <i class="fa fa-user"></i>
                  </div>
                </div>
                <div class="col-md-4 user-account" id="user"></div>
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
<script src="<?php echo dirname($_SERVER['PHP_SELF']);?>/js/profile.js"></script>
</html>
