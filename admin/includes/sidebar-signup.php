<!-- Sidebar -->
<div id="sidebar-wrapper">
  <ul class="sidebar-nav">
    <li class="sidebar-brand">
      <a href="../">This Movie Year</a>
    </li>
    <?php
      $pageurl = $_SERVER['PHP_SELF'];
      $page = substr($pageurl, strrpos($pageurl, '/') + 1);
  
      if (strpos($pageurl, 'includes') !== false) { ?>
        <li><a href="<?php echo dirname($_SERVER['PHP_SELF']);?>/../index.php"><i class="fa fa-tachometer"></i> Dashboard</a></li>
        <li><a href="<?php echo dirname($_SERVER['PHP_SELF']);?>/../movies.php"><i class="fa fa-film"></i> Movies</a></li>
        <li><a href="<?php echo dirname($_SERVER['PHP_SELF']);?>/../writer.php"><i class="fa fa-pencil"></i> Writer</a></li>
        <li><a href="<?php echo dirname($_SERVER['PHP_SELF']);?>/../setup.html"><i class="fa fa-wrench"></i> Setup Guide</a></li>
      <?php } else { ?>
        <li><a href="<?php echo dirname($_SERVER['PHP_SELF']);?>/index.php"><i class="fa fa-tachometer"></i> Dashboard</a></li>
        <li><a href="<?php echo dirname($_SERVER['PHP_SELF']);?>/movies.php"><i class="fa fa-film"></i> Movies</a></li>
        <li><a href="<?php echo dirname($_SERVER['PHP_SELF']);?>/writer.php"><i class="fa fa-pencil"></i> Writer</a></li>
        <li><a href="<?php echo dirname($_SERVER['PHP_SELF']);?>/setup.html"><i class="fa fa-wrench"></i> Setup Guide</a></li>
      <?php }; ?>
  </ul>
</div>
<!-- /#sidebar-wrapper -->