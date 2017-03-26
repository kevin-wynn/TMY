<?php include '../includes/connection.php' ?>
<?php
  connect();

  $json = array();
  $count = mysql_query("SELECT COUNT(genre) AS 'drama' FROM movies WHERE genre LIKE '%drama%';");
  while($row = mysql_fetch_array($count))
  {
    $bus = array(
      'Drama' => $row['drama']
    );
    array_push($json, $bus);
  }

  $count2 = mysql_query("SELECT COUNT(genre) AS 'adventure' FROM movies WHERE genre LIKE '%adventure%';");
  while($row = mysql_fetch_array($count2))
  {
    $bus = array(
      'Adventure' => $row['adventure']
    );
    array_push($json, $bus);
  }

  $count3 = mysql_query("SELECT COUNT(genre) AS 'scifi' FROM movies WHERE genre LIKE '%science fiction%';");
  while($row = mysql_fetch_array($count3))
  {
    $bus = array(
      'Scifi' => $row['scifi']
    );
    array_push($json, $bus);
  }

  $count4 = mysql_query("SELECT COUNT(genre) AS 'horror' FROM movies WHERE genre LIKE '%horror%';");
  while($row = mysql_fetch_array($count4))
  {
    $bus = array(
      'Horror' => $row['horror']
    );
    array_push($json, $bus);
  }

  $count5 = mysql_query("SELECT COUNT(genre) AS 'action' FROM movies WHERE genre LIKE '%action%';");
  while($row = mysql_fetch_array($count5))
  {
    $bus = array(
      'Action' => $row['action']
    );
    array_push($json, $bus);
  }

  $count6 = mysql_query("SELECT COUNT(genre) AS 'thriller' FROM movies WHERE genre LIKE '%thriller%';");
  while($row = mysql_fetch_array($count6))
  {
    $bus = array(
      'Thriller' => $row['thriller']
    );
    array_push($json, $bus);
  }

  $count7 = mysql_query("SELECT COUNT(genre) AS 'comedy' FROM movies WHERE genre LIKE '%comedy%';");
  while($row = mysql_fetch_array($count7))
  {
    $bus = array(
      'Comedy' => $row['comedy']
    );
    array_push($json, $bus);
  }

  $count8 = mysql_query("SELECT COUNT(genre) AS 'crime' FROM movies WHERE genre LIKE '%crime%';");
  while($row = mysql_fetch_array($count8))
  {
    $bus = array(
      'Crime' => $row['crime']
    );
    array_push($json, $bus);
  }

  $count9 = mysql_query("SELECT COUNT(genre) AS 'mystery' FROM movies WHERE genre LIKE '%mystery%';");
  while($row = mysql_fetch_array($count9))
  {
    $bus = array(
      'Mystery' => $row['mystery']
    );
    array_push($json, $bus);
  }

  $count10 = mysql_query("SELECT COUNT(genre) AS 'western' FROM movies WHERE genre LIKE '%western%';");
  while($row = mysql_fetch_array($count9))
  {
    $bus = array(
      'Western' => $row['western']
    );
    array_push($json, $bus);
  }

  $count11 = mysql_query("SELECT COUNT(genre) AS 'history' FROM movies WHERE genre LIKE '%history%';");
  while($row = mysql_fetch_array($count11))
  {
    $bus = array(
      'History' => $row['history']
    );
    array_push($json, $bus);
  }

  $count12 = mysql_query("SELECT COUNT(genre) AS 'fantasy' FROM movies WHERE genre LIKE '%fantasy%';");
  while($row = mysql_fetch_array($count12))
  {
    $bus = array(
      'Fantasy' => $row['fantasy']
    );
    array_push($json, $bus);
  }

  $count13 = mysql_query("SELECT COUNT(genre) AS 'documentary' FROM movies WHERE genre LIKE '%documentary%';");
  while($row = mysql_fetch_array($count13))
  {
    $bus = array(
      'Documentary' => $row['documentary']
    );
    array_push($json, $bus);
  }

  $jsonstring = json_encode($json);
  echo $jsonstring;

  die();
?>
