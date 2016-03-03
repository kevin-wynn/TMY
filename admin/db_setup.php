<link rel="stylesheet" href="css/admin_server.css" type="text/css">

 <?php
  $link = mysql_connect("localhost", "root", "mariocart64");
  mysql_select_db("tmydb");

  $init = "CREATE TABLE IF NOT EXISTS movies (
    movie_title varchar(255),
    overview varchar(255),
    director varchar(255),
    cast varchar(255),
    poster_path varchar(255),
    backdrop_path varchar(255),
    rating int,
    review varchar(255),
    release_date varchar(255),
    publish_date varchar(255),
    published boolean,
    popular_vote varchar(255),
    genre varchar(255)
  )";

  $run = mysql_query($init) or die(mysql_error());

  $sql = "SELECT * FROM movies";
  $result = mysql_query($sql) or die(mysql_error());

  // Print the column names as the headers of a table
  echo "<h1>Patch Scripts Successfully Run: </h1><table><tr>";
  for($i = 0; $i < mysql_num_fields($result); $i++) {
    $field_info = mysql_fetch_field($result, $i);
    echo "<th>{$field_info->name}</th>";
  }

  // Print the data
  while($row = mysql_fetch_row($result)) {
      echo "<tr>";
      foreach($row as $_column) {
          echo "<td>{$_column}</td>";
      }
      echo "</tr>";
  }

  echo "</table>";

  mysql_close($link);
?>