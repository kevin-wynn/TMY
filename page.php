<?php include 'admin/includes/connection.php' ?>
<?php
  connect();  
  
  // get local instance of url and strip down to base
  $pageurl = $_SERVER['PHP_SELF'];
  $pagefinal = substr($pageurl, 0, strrpos( $pageurl, '/'));

  // gather url for htaccess redirect
  $movie = mysql_real_escape_string($_GET['movie_title']);
  $movie = str_replace('-', ' ', $movie);

  //Remove LIMIT 1 to show/do this to all results.
  $query = "SELECT * FROM movies WHERE movie_title = '" . $movie . "' LIMIT 1";
  $result = mysql_query($query);
  $row = mysql_fetch_array($result);
  
  // get backdrop path for css background image on hero
  $backdrop = $row['backdrop_path'];
  $poster = $row['poster_path'];
  $score = $row['score'];
  $cast = $row['cast'];
  $trailer = $row['trailer'];

  $cast = preg_replace('/\.$/', '', $cast); //Remove dot at end if exists
  $array = explode(', ', $cast); //split string into array seperated by ', '
?>
<script>
  var score = <?php echo $score ?>;
  var <?php
  
  foreach($array as $key=>$value) //loop over values
  {
      echo 'cast' . $key . '=' . $value . ';'; //print value
  }
  
  ?>
  
</script>
<?php include 'components/head.php' ?>
<title>This Movie Year</title>
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
     </div>
     <div class="col-md-8 movie-review">
       <h3>Release Date: <?php echo $row['release_date']; ?></h3>
       <h3>Reviewed: <?php echo $row['publish_date']; ?></h3>
       <h3>Popular Vote: <?php echo $row['popular_vote']; ?></h3>
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
</body>
</html>