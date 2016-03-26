<?php include 'admin/includes/connection.php' ?>
<?php
  connect();  
  
  // get local instance of url and strip down to base
  $pageurl = $_SERVER['PHP_SELF'];
  $pagefinal = substr($pageurl, 0, strrpos( $pageurl, '/'));

  // gather url for htaccess redirect
  $movie = mysql_real_escape_string($_GET['movie_title']);
  $movieId = mysql_real_escape_string($_GET['movie_id']);
  $movie = str_replace('-', ' ', $movie);

  //Remove LIMIT 1 to show/do this to all results.
  $query = "SELECT * FROM movies WHERE movie_id = '" . $movieId . "' LIMIT 1";
  $result = mysql_query($query);
  $row = mysql_fetch_array($result);
  
  // get backdrop path for css background image on hero
  $movieTitle = $row['movie_title'];
  $backdrop = $row['backdrop_path'];
  $poster = $row['poster_path'];
  $score = $row['score'];
  $cast = $row['cast'];
  $trailer = $row['trailer'];

  $cast = preg_replace('/\.$/', '', $cast); //Remove dot at end if exists
  $array = explode(', ', $cast); //split string into array seperated by ', '

  $movieReview = str_replace(array("\n", "\t", "\r"), '<br>', ($row['review']));

  $movieReview = (string)$movieReview;
?>
<?php include 'components/head.php' ?>
<title>This Movie Year - <?php echo $movieTitle ?></title>
<body>
<div class="wrapper">
  <div class="main-holder">
    <div class="overlay"></div>
    <div class="hero-image" id="heroImage" style="background-image:url('<?php echo $pagefinal; echo $backdrop; ?>')"></div>
    
    <?php include 'components/navbar.php' ?>
    
    <div class="container-fluid">
      <div class="col-md-10 col-md-offset-1 intro">
        <div class="title" id="movieTitle"><?php echo $row['movie_title']; ?></div>
        <div class="genres" id="movieGenres"><?php echo $row['genre']; ?></div>
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
     <div class="col-md-4">
       <img class="poster" src="<?php echo $pagefinal; echo $poster; ?>">
       <span class="release-date movie-info">Release Date: <span class="prop"><?php echo $row['release_date']; ?></span></span>
       <span class="review-date movie-info">Reviewed: <span class="prop"><?php echo $row['publish_date']; ?></span></span>
       <span class="popular-vote movie-info">Popular Vote: <span class="prop"><?php echo $row['popular_vote']; ?></span></span>
     </div>
     <div class="col-md-8 movie-review">
       <h1 class="movie-title"><?php echo $movieTitle ?></h1>
       <div id="movieTrailer" class="trailer-container"><iframe src="<?php echo $trailer ?>?modestbranding=1;controls=0;showinfo=0;rel=0;fs=1" frameborder="0" allowfullscreen></iframe></div>
       <p><?php echo nl2br($row['review']); ?></p>
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
<script>
  $(document).ready(function(){
    function movieData(){
      var score = <?php echo $score ?>;
      var review = "<?php echo $movieReview ?>";
      var <?php

      foreach($array as $key=>$value) //loop over values
      {
          echo 'cast' . $key . '=' . $value . ';'; //print value
      }

      ?> 

      buildPage(score, review, cast);
    }
  });
</script>
<script src="../js/page.js"></script>
</body>
</html>