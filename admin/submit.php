<?php

  $link = mysql_connect("localhost", "root", "mariocart64");
  mysql_select_db("tmydb");

  $query = "INSERT INTO movies (movie_title, review)
            VALUES('$_POST[movie_title]', '$_POST[review]')";

  $run = mysql_query($query) or die(mysql_error());
              
  echo "submitted dude <br>";

  mysql_close($link);

?>