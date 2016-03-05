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

    </div>
    <!-- /#wrapper -->
</body>
<?php include 'includes/footer.php'; ?>
</html>