<?php 
  $pageurl = $_SERVER['PHP_SELF'];

  $page = substr($pageurl, strrpos($pageurl, '/') + 1);

  if (strpos($page, 'page.php') !== false) { ?>
    <script src="../js/vender/jquery-2.2.1.min.js"></script>
    <script src="../js/vender/bootstrap.min.js"></script>
    <script src="../js/min/initControls.min.js"></script>
    <script src="../js/vender/imagesloaded.pkgd.min"></script>
    <script src="../js/vender/isotope.pkgd.min.js"></script>
    <script src="../js/vender/themoviedb.js"></script>
    <script src="../js/vender/jquery.fitvids.js"></script>
<?php } else if (strpos($page, 'all-movies.php') !== false) { ?>
  <div class="footer">
    <div class="overlay-footer"></div>
    <div class="col-md-3 logo">
      <h1><a href="<?php echo $link ?>">TMY</a></h1>
    </div>
    <div class="col-md-9 nav">
      <ul>
        <li><a href="all-movies">All Movies</a></li>
<!--        <li><a href="about">About TMY</a></li>-->
<!--        <li><a href="contact">Contact</a></li>-->
        <li class="login-button"><a href="<?php echo $link ?>admin/login.php">Log in</a></li>
      </ul>
    </div>
  </div>
  <script src="js/vender/jquery-2.2.1.min.js"></script>
  <script src="js/vender/bootstrap.min.js"></script>
  <script src="js/min/initControls.min.js"></script>
  <script src="js/vender/imagesloaded.pkgd.min"></script>
  <script src="js/vender/isotope.pkgd.min.js"></script>
  <script src="js/vender/fit-columns.js"></script>
  <script src="js/vender/themoviedb.js"></script>
  <script src="js/min/sortfilter.min.js"></script>
  <script src="js/min/all-movies.min.js"></script>
  <script src="js/vender/jquery.fitvids.js"></script>
  
<?php } else if (strpos($page, 'about.php') !== false) { ?>
  <div class="footer">
    <div class="overlay-footer"></div>
    <div class="col-md-3 logo">
      <h1><a href="<?php echo $link ?>">TMY</a></h1>
    </div>
    <div class="col-md-9 nav">
      <ul>
        <li><a href="all-movies">All Movies</a></li>
<!--        <li><a href="about">About TMY</a></li>-->
<!--        <li><a href="contact">Contact</a></li>-->
        <li class="login-button"><a href="<?php echo $link ?>admin/login.php">Log in</a></li>
      </ul>
    </div>
  </div>
  <script src="js/vender/jquery-2.2.1.min.js"></script>
  <script src="js/vender/bootstrap.min.js"></script>
  <script src="js/min/initControls.min.js"></script>
  <script src="js/vender/imagesloaded.pkgd.min"></script>
  <script src="js/vender/isotope.pkgd.min.js"></script>
  <script src="js/vender/fit-columns.js"></script>
  <script src="js/vender/themoviedb.js"></script>
  <script src="js/min/sortfilter.js"></script>
  <script src="js/min/about.min.js"></script>
  <script src="js/vender/jquery.fitvids.js"></script>
  
<?php } else { ?>

  <div class="footer">
    <div class="overlay-footer"></div>
    <div class="col-md-3 logo">
      <h1><a href="<?php echo $link ?>">TMY</a></h1>
    </div>
    <div class="col-md-9 nav">
      <ul>
        <li><a href="all-movies">All Movies</a></li>
<!--        <li><a href="about">About TMY</a></li>-->
<!--        <li><a href="contact">Contact</a></li>-->
        <li class="login-button"><a href="<?php echo $link ?>admin/login.php">Log in</a></li>
      </ul>
    </div>
  </div>
  <script src="js/vender/jquery-2.2.1.min.js"></script>
  <script src="js/vender/bootstrap.min.js"></script>
  <script src="js/min/initControls.min.js"></script>
  <script src="js/vender/imagesloaded.pkgd.min"></script>
  <script src="js/vender/isotope.pkgd.min.js"></script>
  <script src="js/vender/fit-columns.js"></script>
  <script src="js/vender/themoviedb.js"></script>
  <script src="js/min/sortfilter.min.js"></script>
  <script src="js/min/home.min.js"></script>
  <script src="js/vender/jquery.fitvids.js"></script>
<?php } ?>