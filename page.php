<?php include 'components/head.php' ?>
<title>This Movie Year - <?php echo $movieTitle ?></title>
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
          <div class="director" id="movieDirector"><span class="intro-text">Directed By - </span><?php echo $row['director']; ?></div>
          <div class="cast" id="movieCast"><span class="intro-text">Starring - </span><?php echo $row['cast']; ?></div>
        </div>
        <div class="overview" id="movieOverview"><?php echo $row['overview']; ?></div>
        <div class="score" id="movieScore"></div>
      </div>
    </div>
  </div>
  <div class="container-fluid">
    <div class="col-md-10 col-md-offset-1 movie-details" id="movieDetails">
     <div class="col-md-4" id="moviePoster">
       <div class="col-md-12" id="similarMovies"></div>
       <span class="release-date movie-info">Release Date: </span>
       <span class="review-date movie-info">Reviewed: </span>
       <span class="popular-vote movie-info">Popular Vote: </span>
     </div>
     <div class="col-md-8 movie-review">
       <div id="pageContent"></div>
      </div>
    </div>
  </div>
</div>
<div class="footer" style="background-image:url('<?php echo $pagefinal; echo $backdrop; ?>')">
  <div class="overlay-footer"></div>
  <div class="col-md-3 logo">
    <h1><a href="<?php echo $link ?>">TMY</a></h1>
  </div>
  <div class="col-md-9 nav">
    <ul>
      <li><a href="../all-movies">All Movies</a></li>
      <li><a href="../categories">Categories</a></li>
      <li><a href="../about">About TMY</a></li>
      <li><a href="../contact">Contact</a></li>
    </ul>
  </div>
</div>
<?php include 'components/footer.php' ?>
<script src="../js/min/page.min.js"></script>
</body>
</html>