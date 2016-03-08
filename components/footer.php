<script src="https://code.jquery.com/jquery-2.2.1.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

<!-- if page is in /movies/page.php then you need to backtrack for the js file -->
<?php 
  $pageurl = $_SERVER['PHP_SELF'];

  $page = substr($pageurl, strrpos($pageurl, '/') + 1);

  if (strpos($page, 'page.php') !== false) { ?>
    <script src="../js/themoviedb.js"></script>
    <script src="../js/page.js"></script>
    <script src="../js/sortfilter.js"></script>
<?php } else if (strpos($page, 'all-movies.php') !== false) { ?>
  <div class="footer">
    <div class="overlay-footer"></div>
    <div class="col-md-3 logo">
      <h1><a href="<?php echo $link ?>">TMY</a></h1>
    </div>
    <div class="col-md-9 nav">
      <ul>
        <li><a href="all-movies">All Movies</a></li>
        <li><a href="categories">Categories</a></li>
        <li><a href="about">About TMY</a></li>
        <li><a href="contact">Contact</a></li>
      </ul>
    </div>
  </div>

  <script src="js/themoviedb.js"></script>
  <script src="js/all-movies.js"></script>
  <script src="js/sortfilter.js"></script>
<?php } else { ?>

  <div class="footer">
    <div class="overlay-footer"></div>
    <div class="col-md-3 logo">
      <h1><a href="<?php echo $link ?>">TMY</a></h1>
    </div>
    <div class="col-md-9 nav">
      <ul>
        <li><a href="all-movies">All Movies</a></li>
        <li><a href="categories">Categories</a></li>
        <li><a href="about">About TMY</a></li>
        <li><a href="contact">Contact</a></li>
      </ul>
    </div>
  </div>

  <script src="js/themoviedb.js"></script>
  <script src="js/home.js"></script>
  <script src="js/sortfilter.js"></script>
<?php } ?>