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
            <h1>Dashboard</h1>
            <div class="col-md-4">
            <p>Server Status:</p>
              <?php
            
                $server = $_SERVER['SERVER_NAME'] . dirname($_SERVER['PHP_SELF']);
              
                $status =  GetServerStatus($server,80);

                function GetServerStatus($site, $port)
                {
                $status = array("<i class='fa fa-circle offline'></i> OFFLINE", "<i class='fa fa-circle online'></i> ONLINE");
                $fp = @fsockopen($site, $port, $errno, $errstr, 2);
                if (!$fp) {
                   echo $status[0];
                } else 
                   echo $status[1];
                }
              ?>
            </div>
            <div class="col-md-4">
              <p>Server Time:</p>
              <?php
                $dt = new DateTime("now", new DateTimeZone('America/Chicago'));
                echo "<i class='fa fa-clock-o'></i> ";
                echo $dt->format('m/d/Y, h:i:s');
              ?>
            </div>
            <div class="col-md-4">
              
            </div>
            <div class="col-md-12">

            </div>
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