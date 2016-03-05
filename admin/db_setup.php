<!DOCTYPE html>
<html>
<?php include 'includes/head.php'; ?>
<title>TMY Admin Page</title>
<body>
    <div id="wrapper">

    <!-- Sidebar -->
    <div id="sidebar-wrapper">
      <ul class="sidebar-nav">
        <li class="sidebar-brand">This Movie Year</li>
        <li><a href="<?php echo dirname($_SERVER['PHP_SELF']);?>/index.php"><i class="fa fa-tachometer"></i> Dashboard</a></li>
        <li><a href="<?php echo dirname($_SERVER['PHP_SELF']);?>/writer.php"><i class="fa fa-pencil"></i> Writer</a></li>
        <li><a href="<?php echo dirname($_SERVER['PHP_SELF']);?>/db_setup.php"><i class="fa fa-database"></i> Database Setup</a></li>
        <li><a href="<?php echo dirname($_SERVER['PHP_SELF']);?>/setup.html"><i class="fa fa-wrench"></i> Setup Guide</a></li>
      </ul>
    </div>
    <!-- /#sidebar-wrapper -->

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