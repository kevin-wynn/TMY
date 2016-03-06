  <script src="https://code.jquery.com/jquery-2.2.1.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
  
  <?php 
  $pageurl = $_SERVER['PHP_SELF'];
  $page = substr($pageurl, strrpos($pageurl, '/') + 1);
  
  if (strpos($pageurl, 'includes') !== false) { ?>
    <script src="<?php echo dirname($_SERVER['PHP_SELF']);?>/../js/themoviedb.js"></script>
    <script src="<?php echo dirname($_SERVER['PHP_SELF']);?>/../js/jquery.raty.js"></script>
  <?php } else { ?>
    <script src="<?php echo dirname($_SERVER['PHP_SELF']);?>/js/themoviedb.js"></script>
    <script src="<?php echo dirname($_SERVER['PHP_SELF']);?>/js/jquery.raty.js"></script>
  <?php };
?>