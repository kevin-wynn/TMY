<?php
  $pageurl = $_SERVER['PHP_SELF'];
  $page = substr($pageurl, strrpos($pageurl, '/') + 1);
  $link = str_replace($page, "", $pageurl);
?>


<div class="container-fluid navbar">
  <div class="col-md-3 logo">
    <h1><a href="<?php echo $link ?>">TMY</a></h1>
  </div>
    <div class="col-md-9 nav login">
      <ul>
        <?php if (strpos($page, 'page.php') !== false) { ?>
          <li><a href="../all-movies">All Movies</a></li>
<!--          <li><a href="../about">About TMY</a></li>-->
<!--          <li><a href="../contact">Contact</a></li>-->
          <!-- <li class="login-button"><a href="<?php echo $link ?>../admin/login.php">Log in</a></li> -->
        <?php } else { ?>
          <li><a href="all-movies">All Movies</a></li>
<!--          <li><a href="about">About TMY</a></li>-->
<!--          <li><a href="contact">Contact</a></li>-->
          <!-- <li class="login-button"><a href="<?php echo $link ?>admin/login.php">Log in</a></li> -->
        <?php } ?>
      </ul>
    </div>
</div>
