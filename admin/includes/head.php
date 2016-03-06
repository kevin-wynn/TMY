<?php include 'includes/admin_check.php'; ?>
<head>
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
  <link href='https://fonts.googleapis.com/css?family=Raleway:400,500,700' rel='stylesheet' type='text/css'>

<?php 
  $pageurl = $_SERVER['PHP_SELF'];
  $page = substr($pageurl, strrpos($pageurl, '/') + 1);
  
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