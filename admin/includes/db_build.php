<?php include 'build.php'; ?>
<?php include 'connection.php'; ?>
<link rel="stylesheet" type="text/css" href="../css/admin.css">

<?php
  $dbuser = $_POST[dbuser];
  $dbpass = $_POST[dbpass];
  $dbname = $_POST[dbname];

  build($dbuser, $dbpass, $dbname);

  $init = "CREATE TABLE IF NOT EXISTS movies (
    movie_title varchar(255),
    overview varchar(10000),
    director varchar(255),
    cast varchar(255),
    poster_path varchar(255),
    backdrop_path varchar(255),
    score int,
    review text,
    release_date varchar(255),
    publish_date varchar(255),
    featured boolean,
    popular_vote varchar(255),
    genre varchar(255),
    trailer varchar(255)
  )";

  $run = mysql_query($init) or die(mysql_error());

  $usersDB = "CREATE TABLE IF NOT EXISTS users (
    user_id int(11) NOT NULL auto_increment,
    username varchar(100) NOT NULL,
    password char(128) NOT NULL,
    PRIMARY KEY (user_id),
    UNIQUE KEY username (username),
    email varchar(255) NOT NULL,
    permissions int,
    last_login DATE,
    url_slug varchar(255),
    f_name varchar(128),
    l_name varchar(128),
    headshot varchar(1000),
    signup_date DATE
  )";

  $buildUsers = mysql_query($usersDB) or die(mysql_error());

  $sql = "SELECT * FROM movies";
  $result = mysql_query($sql) or die(mysql_error());

  $sql2 = "SELECT * FROM credentials";
  $result2 = mysql_query($sql2) or die(mysql_error());

  $sql3 = "SELECT * from users";
  $result3 = mysql_query($sql3) or die(mysql_error());

  // Print the column names as the headers of a table
  echo "<h1>Patch Scripts Successfully Run: </h1><h3>Movies Table:</h3><table><tr>";
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

  echo "<h3>Credentials:</h3><table><tr>";
  for($i = 0; $i < mysql_num_fields($result2); $i++) {
    $field_info = mysql_fetch_field($result2, $i);
    echo "<th>{$field_info->name}</th>";
  }

  while($row = mysql_fetch_row($result2)) {
      echo "<tr>";
      foreach($row as $_column) {
          echo "<td>{$_column}</td>";
      }
      echo "</tr>";
  }

  echo "</table>";

  echo "<h3>Users:</h3><table><tr>";
  for($i = 0; $i < mysql_num_fields($result3); $i++) {
    $field_info = mysql_fetch_field($result3, $i);
    echo "<th>{$field_info->email}</th>";
  }

  while($row = mysql_fetch_row($result3)) {
      echo "<tr>";
      foreach($row as $_column) {
          echo "<td>{$_column}</td>";
      }
      echo "</tr>";
  }

  echo "</table>";
?>
