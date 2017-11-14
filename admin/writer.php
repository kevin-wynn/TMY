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
            <div class="col-lg-12">
              <h1>Writer</h1>
              <div class="search-field">
                <p class="search-label tmy-label">Search for movie:</p> <input id="searchBox" class="search-box tmy-input" type="text" name="search" autofocus>
              </div>

              <div class="col-md-12 results" id="resultsContainer"></div>

              <form class="review" action="<?php echo dirname($_SERVER['PHP_SELF']);?>/includes/submit-review.php" method="post">
                <p>Rating: </p><div class="rating"></div>
                <input class="tmy-input-hidden" type="hidden" name="movie_title">
                <input class="tmy-input-hidden" type="hidden" name="moviedb_id">
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
                <input class="tmy-input-hidden" type="hidden" name="trailer">
                <input class="tmy-input-hidden" type="hidden" name="backdrop2_path">
                <input class="tmy-input-hidden" type="hidden" name="backdrop3_path">
                <input class="tmy-input-hidden" type="hidden" name="poster2_path">
                <p>Review: </p>
                <textarea class="editor" name="review"></textarea><br>
                <input class="btn button-primary" type="submit" value="Submit">
                <span class="submit-error"></span>
              </form>
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
<script src="<?php echo dirname($_SERVER['PHP_SELF']);?>/js/admin.js"></script>
</html>
