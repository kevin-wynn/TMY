<?php 
$pageurl = $_SERVER['PHP_SELF'];
$page = substr($pageurl, strrpos($pageurl, '/') + 1);

if (strpos($pageurl, 'includes') !== false) { ?>
  <script src="<?php echo dirname($_SERVER['PHP_SELF']);?>/../js/jquery-2.2.1.min.js"></script>
  <script src="<?php echo dirname($_SERVER['PHP_SELF']);?>/../js/bootstrap.min.js"></script>
  <script src="<?php echo dirname($_SERVER['PHP_SELF']);?>/../js/tinymce.min.js"></script>
  <script src="<?php echo dirname($_SERVER['PHP_SELF']);?>/../js/themoviedb.js"></script>
  <script src="<?php echo dirname($_SERVER['PHP_SELF']);?>/../js/jquery.raty.js"></script>
  <script src="<?php echo dirname($_SERVER['PHP_SELF']);?>/../js/permissions.js"></script>
<?php } else { ?>
  <script src="<?php echo dirname($_SERVER['PHP_SELF']);?>/js/jquery-2.2.1.min.js"></script>
  <script src="<?php echo dirname($_SERVER['PHP_SELF']);?>/js/bootstrap.min.js"></script>
  <script src="<?php echo dirname($_SERVER['PHP_SELF']);?>/js/tinymce.min.js"></script>
  <script src="<?php echo dirname($_SERVER['PHP_SELF']);?>/js/themoviedb.js"></script>
  <script src="<?php echo dirname($_SERVER['PHP_SELF']);?>/js/jquery.raty.js"></script>
  <script src="<?php echo dirname($_SERVER['PHP_SELF']);?>/js/permissions.js"></script>
<?php }; ?>