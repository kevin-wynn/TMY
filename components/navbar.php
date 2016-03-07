<?php 
  $pageurl = $_SERVER['PHP_SELF'];
  $uri = $_SERVER['REQUEST_URI'];
  $page = substr($pageurl, strrpos($pageurl, '/') + 1);
  $check = str_replace($test, $page);
  $link = str_replace($page, "", $pageurl);
?>


<div class="container-fluid navbar">
  <div class="col-md-3 logo">
    <h1><a href="<?php echo $link ?>">TMY</a></h1>
  </div>
  <div class="col-md-2 col-md-offset-7 login">
    <a href="<?php echo $link ?>admin/login.php">Log in</a>
  </div>
</div>