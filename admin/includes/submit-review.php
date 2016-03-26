<?php include 'connection.php'; ?>

<?php

  connect();

  // build poster url and hash image name from movie title
  $posterUrl = $_POST[poster_path];
  $posterHash = hash('sha1', $_POST[movie_title]);

  // build out local and save paths
  $posterSavePath = '../../assets/images/posters/'. $posterHash . '.jpg';
  $posterLocalPath = '/assets/images/posters/'. $posterHash . '.jpg';
  $poster = copy($_POST[poster_path], $posterSavePath);

  // do the same stuff with backdrops
  $backdropUrl = $_POST[backdrop_path];
  $backdropHash = hash('sha1', $_POST[backdrop_path]);
  $backdropSavePath = '../../assets/images/backdrops/'. $backdropHash . '.jpg';
  $backdropLocalPath = '/assets/images/backdrops/'. $backdropHash . '.jpg';

  $backdrop = copy($_POST[backdrop_path], $backdropSavePath);

  // escape any quotes so it doesnt break sql insert
  $overview = addslashes($_POST[overview]);
  $review = addslashes($_POST[review]);
  $director = addslashes($_POST[director]);

  $overview = iconv("UTF-8", "UTF-8//IGNORE", $overview);
  $review = iconv("UTF-8", "UTF-8//IGNORE", $review);
  $director = iconv("UTF-8", "UTF-8//IGNORE", $director);

  // build sql query
  $query = "INSERT INTO movies (
    movie_title,
    overview,
    director,
    cast,
    poster_path,
    backdrop_path,
    release_date,
    publish_date,
    popular_vote,
    genre,
    review,
    score,
    trailer,
    featured
  ) VALUES (
    '$_POST[movie_title]',
    '$overview',
    '$director',
    '$_POST[cast]',
    '$posterLocalPath',
    '$backdropLocalPath',
    '$_POST[release_date]',
    '$_POST[publish_date]',
    '$_POST[popular_vote]',
    '$_POST[genre]',
    '$review',
    '$_POST[score]',
    '$_POST[trailer]',
    '0'
  )";

  // run it
  $run = mysql_query($query) or die(mysql_error());
              
  echo "submitted dude <br>";

?>