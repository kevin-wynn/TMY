<?php include 'connection.php'; ?>

<?php

  connect();

  // build poster url and hash image name from movie title
  $posterHash = hash('sha1', rand());
  $poster2Hash = hash('sha1', rand());

  // build out local and save paths
  $posterSavePath = '../../assets/images/posters/'. $posterHash . '.jpg';
  $poster2SavePath = '../../assets/images/posters/'. $poster2Hash . '.jpg';
  $posterLocalPath = '/assets/images/posters/'. $posterHash . '.jpg';
  $poster2LocalPath = '/assets/images/posters/'. $poster2Hash . '.jpg';
  $poster = copy($_POST[poster_path], $posterSavePath);
  $poster2 = copy($_POST[poster2_path], $poster2SavePath);

  // do the same stuff with backdrops
  $backdropHash = hash('sha1', rand());
  $backdrop2Hash = hash('sha1', rand());
  $backdrop3Hash = hash('sha1', rand());
  $backdropSavePath = '../../assets/images/backdrops/'. $backdropHash . '.jpg';
  $backdrop2SavePath = '../../assets/images/backdrops/'. $backdrop2Hash . '.jpg';
  $backdrop3SavePath = '../../assets/images/backdrops/'. $backdrop3Hash . '.jpg';
  $backdropLocalPath = '/assets/images/backdrops/'. $backdropHash . '.jpg';
  $backdrop2LocalPath = '/assets/images/backdrops/'. $backdrop2Hash . '.jpg';
  $backdrop3LocalPath = '/assets/images/backdrops/'. $backdrop3Hash . '.jpg';

  $backdrop = copy($_POST[backdrop_path], $backdropSavePath);
  $backdrop2 = copy($_POST[backdrop2_path], $backdrop2SavePath);
  $backdrop3 = copy($_POST[backdrop3_path], $backdrop3SavePath);

  // escape any quotes so it doesnt break sql insert
  $movieName = addslashes($_POST[movie_title]);
  $overview = addslashes($_POST[overview]);
  $review = addslashes($_POST[review]);
  $director = addslashes($_POST[director]);

  $overview = iconv("UTF-8", "UTF-8//IGNORE", $overview);
  $review = iconv("UTF-8", "UTF-8//IGNORE", $review);
  $director = iconv("UTF-8", "UTF-8//IGNORE", $director);

  // build sql query
  $query = "INSERT INTO movies (
    moviedb_id,
    movie_title,
    overview,
    director,
    cast,
    poster_path,
    poster2_path,
    backdrop_path,
    backdrop2_path,
    backdrop3_path,
    release_date,
    publish_date,
    popular_vote,
    genre,
    review,
    score,
    trailer,
    featured
  ) VALUES (
    '$_POST[moviedb_id]',
    '$movieName',
    '$overview',
    '$director',
    '$_POST[cast]',
    '$posterLocalPath',
    '$poster2LocalPath',
    '$backdropLocalPath',
    '$backdrop2LocalPath',
    '$backdrop3LocalPath',
    '$_POST[release_date]',
    '$_POST[publish_date]',
    '$_POST[popular_vote]',
    '$_POST[genre]',
    '$review',
    '$_POST[score]',
    '$_POST[trailer]',
    '0')";

  // run it
  $run = mysql_query($query) or die(mysql_error());
              
  echo "submitted dude <br>";

?>