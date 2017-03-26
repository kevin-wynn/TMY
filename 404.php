<!DOCTYPE html>
<html>
<?php include 'components/head.php';

  $pageurl = $_SERVER['PHP_SELF'];
  $uri = $_SERVER['REQUEST_URI'];
  $page = substr($pageurl, strrpos($pageurl, '/') + 1);
  $check = str_replace($test, "", $page);
  $link = str_replace($page, "", $pageurl);
?>
<title>This Movie Year - 404</title>
<body>
<div class="wrapper">
    <div class="container-fluid">
      <div class="col-md-10 col-md-offset-1 oops">
        <div class="col-md-6">
          <img src="assets/images/404/confused_vincent_vega.gif"/>
        </div>
        <div class="col-md-6">
          <h1>oops 404</h1>
          <h2>It doesn't seem like we can find the page you're looking for</h2>
          <h4>Maybe try looking through <a href="all-movies.php">all our movies</a>?</h4>
          <h4>Or go back <a href="<?php echo $link ?>">home</a>?</h4>
          <h4>Or, just do some searching?</h4>
          <input id="searchBox" class="search-box tmy-input" type="text" name="search" autofocus>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>
