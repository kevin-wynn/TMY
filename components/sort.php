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
?>

<div class="col-md-10 col-md-offset-1 sort" id="sortMovies">
 <h4>Recent Movies Reviewed</h4>
  <a class="sort-filter" id="sortAction">Sort Movies <i class="fa fa-sort"></i></a>
<!--  <a class="sort-filter" id="filterAction">Filter Movies <i class="fa fa-sort"></i></a>-->
  <ul id="sortItems" class="sort-dropdown">
    <li id="sortReviewed">Recently Reviewed</li>
    <li id="sortReleased">Recently Released</li>
  </ul>
<!--  <ul id="filterItems" class="sort-dropdown">-->
  </ul>
</div>