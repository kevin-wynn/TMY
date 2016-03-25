<?php 
$pageurl = $_SERVER['PHP_SELF'];
$page = substr($pageurl, strrpos($pageurl, '/') + 1);

if (strpos($pageurl, 'includes') !== false) { ?>
  <script src="<?php echo dirname($_SERVER['PHP_SELF']);?>/../js/vender/jquery-2.2.1.min.js"></script>
  <script src="<?php echo dirname($_SERVER['PHP_SELF']);?>/../js/vender/bootstrap.min.js"></script>
  <script src="<?php echo dirname($_SERVER['PHP_SELF']);?>/../js/vender/imagesloaded.pkgd.min.js"></script>
  <script src="<?php echo dirname($_SERVER['PHP_SELF']);?>/../js/vender/isotope.pkgd.min.js"></script>
  <script src="<?php echo dirname($_SERVER['PHP_SELF']);?>/../js/vender/tinymce.min.js"></script>
  <script src="<?php echo dirname($_SERVER['PHP_SELF']);?>/../js/vender/themoviedb.js"></script>
  <script src="<?php echo dirname($_SERVER['PHP_SELF']);?>/../js/vender/jquery.raty.js"></script>
  <script src="<?php echo dirname($_SERVER['PHP_SELF']);?>/../js/vender/chart.min.js"></script>
  <script src="<?php echo dirname($_SERVER['PHP_SELF']);?>/../js/permissions.js"></script>
  <script src="<?php echo dirname($_SERVER['PHP_SELF']);?>/../js/sortfilter.js"></script>
<?php } else { ?>
  <script src="<?php echo dirname($_SERVER['PHP_SELF']);?>/js/vender/jquery-2.2.1.min.js"></script>
  <script src="<?php echo dirname($_SERVER['PHP_SELF']);?>/js/vender/bootstrap.min.js"></script>
  <script src="<?php echo dirname($_SERVER['PHP_SELF']);?>/js/vender/imagesloaded.pkgd.min.js"></script>
  <script src="<?php echo dirname($_SERVER['PHP_SELF']);?>/js/vender/isotope.pkgd.min.js"></script>
  <script src="<?php echo dirname($_SERVER['PHP_SELF']);?>/js/vender/tinymce.min.js"></script>
  <script src="<?php echo dirname($_SERVER['PHP_SELF']);?>/js/vender/themoviedb.js"></script>
  <script src="<?php echo dirname($_SERVER['PHP_SELF']);?>/js/vender/jquery.raty.js"></script>
  <script src="<?php echo dirname($_SERVER['PHP_SELF']);?>/js/vender/chart.min.js"></script>
  <script src="<?php echo dirname($_SERVER['PHP_SELF']);?>/js/permissions.js"></script>
  <script src="<?php echo dirname($_SERVER['PHP_SELF']);?>/js/sortfilter.js"></script>
<?php }; ?>