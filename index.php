
<!DOCTYPE html>
<html>
<?php include 'components/head.php' ?>
<title>This Movie Year</title>
<body>
<div class="wrapper">
  <div class="main-holder">
    <div class="overlay"></div>
    <div class="hero-image" id="heroImage"></div>

    <?php include 'components/navbar.php' ?>

    <div class="container-fluid">
      <div class="col-md-8 col-md-offset-2 intro">
          <div class="title" id="movieTitle"></div>
          <div class="genres" id="movieGenres"></div>
          <div class="credits">
            <div class="director" id="movieDirector"></div>
            <div class="cast" id="movieCast"></div>
          </div>
          <div class="overview" id="movieOverview"></div>
          <div class="score" id="movieScore"></div>
          <div class="review-link" id="seeReview"></div>
      </div>
    </div>
  </div>
  <div class="container-fluid recent">
    <div class="row">
      <?php include 'components/discover.php' ?>
      <?php include 'components/nowPlaying.php' ?>
    </div>
    <?php include 'components/moviesContainer.php' ?>
    <?php include 'components/featureNowPlaying.php' ?>
  </div>
</div>
<?php include 'components/footer.php' ?>
</body>
</html>
