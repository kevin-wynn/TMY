<!DOCTYPE html>
<html>
<?php include 'includes/head.php'; ?>
<title>TMY Admin Page</title>
<body>
    <div id="wrapper">
    
    <?php include 'includes/sidebar.php'; ?>

    <!-- Page Content -->
    <div id="page-content-wrapper">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <h1>Database Setup</h1>
            
            <form class="server-setup" action="<?php echo dirname($_SERVER['PHP_SELF']);?>/includes/db_build.php" method="post">
              <p>Mysql Username: </p>
              <input class="tmy-input server" type="text" name="dbuser"><br>
              <p>Mysql Password: </p>
              <input class="tmy-input server" type="text" name="dbpass"><br>
              <br>
              <input class="btn button-primary" type="submit" value="Build">
            </form>
            
            <form class="server-reset" action="<?php echo dirname($_SERVER['PHP_SELF']);?>/includes/db_reset.php" method="post">
              <input class="btn button-primary" type="submit" value="Reset Movies Table">
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->
</body>
<?php include 'includes/footer.php'; ?>
</html>