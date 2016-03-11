<?php include 'includes/admin_check.php'; ?>
<head>
<?php 
  $pageurl = $_SERVER['PHP_SELF'];
  $page = substr($pageurl, strrpos($pageurl, '/') + 1); ?>
  
    <link rel="stylesheet" href="<?php echo $pageurl ?>/../css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo $pageurl ?>/../css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo $pageurl ?>/../css/raleway.css">
  
  <?php
  
  if (strpos($pageurl, 'includes') !== false) { ?>
    <link rel="stylesheet" type="text/css" href="<?php echo dirname($_SERVER['PHP_SELF']);?>/../css/simple-sidebar.css">
    <link rel="stylesheet" type="text/css" href="<?php echo dirname($_SERVER['PHP_SELF']);?>/../css/admin.css">
    <link rel="stylesheet" type="text/css" href="<?php echo dirname($_SERVER['PHP_SELF']);?>/../css/jquery.raty.css">
  <?php } else { ?>
    <link rel="stylesheet" type="text/css" href="<?php echo dirname($_SERVER['PHP_SELF']);?>/css/simple-sidebar.css">
    <link rel="stylesheet" type="text/css" href="<?php echo dirname($_SERVER['PHP_SELF']);?>/css/admin.css">
    <link rel="stylesheet" type="text/css" href="<?php echo dirname($_SERVER['PHP_SELF']);?>/css/jquery.raty.css">
  <?php };
?>
</head>