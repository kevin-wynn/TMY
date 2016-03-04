<!DOCTYPE html>
<html>
<?php include 'head.php'; ?>
<title>TMY Admin Page</title>
<body>
    <div id="wrapper">

    <!-- Sidebar -->
    <div id="sidebar-wrapper">
      <ul class="sidebar-nav">
        <li class="sidebar-brand">
          <a href="#">This Movie Year</a>
<!--          <a href="#menu-toggle" class="pull-right" id="menu-toggle"><i class="fa fa-angle-double-left"></i></a>-->
        </li>
        <li><a href="<?php echo dirname($_SERVER['PHP_SELF']);?>/index.php"><i class="fa fa-tachometer"></i> Dashboard</a></li>
        <li><a href="<?php echo dirname($_SERVER['PHP_SELF']);?>/writer.php"><i class="fa fa-pencil"></i> Writer</a></li>
        <li><a href="<?php echo dirname($_SERVER['PHP_SELF']);?>/db_setup.php"><i class="fa fa-database"></i> Server</a></li>
        <li><a href="<?php echo dirname($_SERVER['PHP_SELF']);?>/setup.html"><i class="fa fa-wrench"></i> Setup Guide</a></li>
      </ul>
    </div>
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <h1>Writer</h1>
            <div class="search-field">
              <p class="search-label">Search for movie:</p> <input class="search-box" type="text" name="search">
            </div>
            
            <form action="submit.php" method="post">
              <input type="text" name="movie_title"><br><br>
              <textarea name="review"></textarea><br>
              <input class="btn button-primary" type="submit" value="Submit">
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->
</body>
</html>