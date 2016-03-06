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
?>
<?php include 'components/head.php' ?>
<title>This Movie Year</title>
<body>
<div class="wrapper">
  <div class="main-holder">
    <div class="overlay"></div>
    <div class="hero-image" id="heroImage" style="background-image:url('<?php echo $pagefinal; echo $backdrop; ?>')"></div>
    <div class="container-fluid navbar">
      <div class="col-md-3 logo">
        <a href="../"><h1>TMY</h1></a>
      </div>
      <div class="col-md-2 col-md-offset-7 login">
        <a href="#">Log in</a>
      </div>
    </div>
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
       <p><?php echo nl2br($row['review']); ?></p>
      </div>
    </div>
  </div>
</div>
<div class="footer" style="background-image:url('<?php echo $pagefinal; echo $backdrop; ?>')">
  <div class="overlay-footer"></div>
  <div class="col-md-3 logo">
    <h1>TMY</h1>
  </div>
  <div class="col-md-9 nav">
    <ul>
      <li><a href="/all-movies">All Movies</a></li>
      <li><a href="/categories">Categories</a></li>
      <li><a href="/about">About TMY</a></li>
      <li><a href="/contact">Contact</a></li>
    </ul>
  </div>
</div>
<?php include 'components/footer.php' ?>
</body>
</html>