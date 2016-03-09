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
      <div class="col-md-10 col-md-offset-1 intro">
        <div class="title" id="movieTitle"></div>
        <div class="genres" id="movieGenres"></div>
        <div class="credits">
          <div class="director" id="movieDirector"></div>
          <div class="cast" id="movieCast"></div>
        </div>
        <div class="overview" id="movieOverview"></div>
        <div class="score" id="movieScore"></div>
      </div>
    </div>
  </div>
  <div class="container-fluid recent">
    <?php include 'components/sort.php' ?>
    <div class="col-md-10 col-md-offset-1" id="recentMovies">
      <div id="noFilterItems" class="col-md-12 no-filter-items"><img src="assets/images/no_filter_items.png"><p>No items to filter</p></div>
    </div>
  </div>
</div>
<?php include 'components/footer.php' ?>
</body>
</html>