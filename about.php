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
  <div class="container-fluid about">
    <div class="col-md-10 col-md-offset-1">
      <h1>What is TMY?</h1>
      <p>Well you see that featured movie up there? What TMY is, or at least started out to be. Was a way to build a "playlist" of movies for that year, for people that I work with to watch over the Christmas break.</p>
      <p>So one thing led to another and I started thinking ya'know what am I even doing here whats this all gonna be? And after some considerable thought. We landed on just making this a movie review/rating site.</p>
      <p>I started building out the site in jekyll and it was coming along nicely, although without a database backing anything it started to get a little out of hand with having to make a "post" for each movie...</p>
      <p>In came this revamp and well, here we are. TMY is a movie rating/review website, allowing users to sign up, create their own playlists and allow others to go along and see whats up, what do others like... etc...</p>
      <p>Hopefully in time we can dig our way into Netflix and Prime and see if we can get some auto rating shit worked out. Until then, do whatever man have fun. Shits free, no ads, fuckin why not.</p>
    </div>
  </div>
</div>
<?php include 'components/footer.php' ?>
</body>
</html>