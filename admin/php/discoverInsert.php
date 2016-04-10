<?php include '../includes/connection.php'; ?>

<?php

  connect();

  // build poster url and hash image name from movie title
  $posterUrl = $_POST['posterUrl'];
  $posterHash = hash('sha1', $_POST[movieName]);

  // build out local and save paths
  $posterSavePath = '../../assets/images/posters/'. $posterHash . '.jpg';
  $posterLocalPath = '/assets/images/posters/'. $posterHash . '.jpg';
  $poster = copy($_POST[posterUrl], $posterSavePath);

  $offset = $_GET['offset'];

  // do the same stuff with backdrops
  $backdropUrl = $_POST[posterBackdropUrl];
  $backdropHash = hash('sha1', $_POST[posterBackdropUrl]);
  $backdropSavePath = '../../assets/images/backdrops/'. $backdropHash . '.jpg';
  $backdropLocalPath = '/assets/images/backdrops/'. $backdropHash . '.jpg';

  $backdrop = copy($_POST[posterBackdropUrl], $backdropSavePath);

  // escape any quotes so it doesnt break sql insert
  $movieName = addslashes($_POST[movieName]);
  $overview = addslashes($_POST[overview]);
  $director = addslashes($_POST[director]);

  $overview = iconv("UTF-8", "UTF-8//IGNORE", $overview);
  $review = iconv("UTF-8", "UTF-8//IGNORE", $review);
  $director = iconv("UTF-8", "UTF-8//IGNORE", $director);

  // build sql query
  $query = "INSERT INTO discovery (
    movie_title,
    overview,
    director,
    cast,
    poster_path,
    backdrop_path,
    release_date,
    popular_vote,
    genre,
    moviedb_id,
    featured
  ) VALUES (
    '$movieName',
    '$overview',
    '$director',
    '$_POST[cast]',
    '$posterLocalPath',
    '$backdropLocalPath',
    '$_POST[releaseDate]',
    '$_POST[popularVote]',
    '$_POST[categories]',
    '$_POST[movieId]',
    '0'
  )";

  // run it
  $run = mysql_query($query) or die(mysql_error());

  $count = mysql_query("SELECT * FROM discovery");
  $num_rows = mysql_num_rows($count);

  echo $num_rows;

?>