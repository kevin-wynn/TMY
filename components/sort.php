<?php include 'admin/includes/connection.php'; connect(); ?>
<?php

  // get all genres and group together
  $query = "SELECT CONCAT('#',REPLACE(REPLACE(GROUP_CONCAT(genre SEPARATOR ','), ' ', ''), ',', ' #')) FROM movies";
  
  // run it
  $getAvail= mysql_query($query) or die(mysql_error());
  
  // combine all the results and remove duplicates
  while($row = mysql_fetch_assoc($getAvail)){
      foreach($row as $cname => $cvalue){
          print '<div style="display:none;" id="genres">' . implode('#',array_unique(explode('#', $cvalue))) . '</div>';
      }
      print "\r\n";
  }
//  
//  // get local instance of url and strip down to base
//  $pageurl = $_SERVER['PHP_SELF'];
//  $pagefinal = substr($pageurl, 0, strrpos( $pageurl, '/'));
//
//  // gather url for htaccess redirect
//  $movie = mysql_real_escape_string($_GET['movie_title']);
//  $movie = str_replace('-', ' ', $movie);
//
//  //Remove LIMIT 1 to show/do this to all results.
//  $query = "SELECT * FROM movies WHERE movie_title = '" . $movie . "' LIMIT 1";
//  $result = mysql_query($query);
//  $row = mysql_fetch_array($result);
//  
//  // get backdrop path for css background image on hero
//  $backdrop = $row['backdrop_path'];
//  $poster = $row['poster_path'];
//  $score = $row['score'];
  
?>

<div class="col-md-10 col-md-offset-1 sort" id="sortMovies">
  <a class="sort-filter" id="sortAction">Sort Movies <i class="fa fa-sort"></i></a>
  <a class="sort-filter" id="filterAction">Filter Movies <i class="fa fa-sort"></i></a>
  <ul id="sortItems" class="sort-dropdown">
    <li id="sortReviewed">Recently Reviewed</li>
    <li id="sortReleased">Recently Released</li>
  </ul>
  <ul id="filterItems" class="sort-dropdown">
  </ul>
</div>