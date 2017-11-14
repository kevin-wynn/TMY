<!DOCTYPE html>
<html>
<?php include 'includes/head.php'; ?>
<?php include 'includes/connection.php'; ?>
<title>TMY Admin Page</title>
<body>
    <div id="wrapper">
      <?php
      echo $_SESSION['user_id'];
      echo isset($_SESSION['user_id']);

      if(isset($_SESSION['user_id'])) {
        echo 'okay';
        include 'includes/utf.php';
        $result = mysqli_query($connect, "SELECT username FROM users WHERE user_id = " . $_SESSION['user_id'] . "");
        $json = array();

        while($row = mysqli_fetch_array($result))
        {
          $bus = array(
            'username' => $row['username']
          );
          array_push($json, $bus);
        }

        $username = json_encode(utf8ize($json));
      }
      ?>
      <?php if($username) { ?>
      <?php include 'includes/sidebar.php'; ?>
      <!-- Page Content -->
      <div id="page-content-wrapper">
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-12 recent home">
              <h1>Dashboard</h1>
              <div class="col-md-8 controls">
                <div class="col-md-6 no-padding">
                  <div class="col-md-3 no-padding">
                    <h5>Movies:</h5>
                    <span class="chart-label" id="totalMovies">Total: </span>
                    <span class="chart-label" id="recentMoviesChart">Recent: </span>
                  </div>
                  <div class="col-md-9 no-padding">
                    <canvas id="movies" style="width:100%;"></canvas>
                  </div>
                </div>
                <div class="col-md-6 no-padding">
                  <div class="col-md-3 no-padding">
                    <h5>Users:</h5>
                    <span class="chart-label" id="totalUsers">Total: </span>
                    <span class="chart-label" id="activeUsers">Active: </span>
                  </div>
                  <div class="col-md-9 no-padding">
                    <canvas id="users" style="width:100%;"></canvas>
                  </div>
                </div>
                <div class="col-md-12 no-padding genres">
                  <h5>Genres:</h5>
                  <canvas id="genres" style="width:100%;"></canvas>
                </div>
                <div class="col-md-12 discovery-movies" id="discovery">
                  <h5>Discovery Movies <small>Choose 4</small></h5><p class="getmovies">retrieve new discovery movies</p>
                  <div id="discoveryMovies"></div>
                </div>
                <div class="col-md-12 nowplaying-movies" id="nowplaying">
                  <h5>Now Playing Movies:</h5><p class="getmovies-nowplaying">retrieve new now playing movies</p>
                  <div id="nowplayingMovies"></div>
                </div>
              </div>
              <div class="col-md-4 no-padding" id="recentMoviesDash">
                <h5>Recently Added Movie:</h5>
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
