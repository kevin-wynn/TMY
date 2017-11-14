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
              <div class="col-md-12">
               <div class="show-more-button" id="getMore">
                 Show More...
               </div>
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
<script src="<?php echo dirname($_SERVER['PHP_SELF']);?>/js/movies.js"></script>
</html>
