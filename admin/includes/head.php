<!-- <?php include 'includes/admin_check.php'; ?> -->
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

<?php
  if (strpos($page, 'page.php') !== false) {
    ?>
    <link rel="icon" type="image/png" href="../../assets/images/favicon-196x196.png" sizes="196x196" />
    <link rel="icon" type="image/png" href="../../assets/images/favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/png" href="../../assets/images/favicon-32x32.png" sizes="32x32" />
    <link rel="icon" type="image/png" href="../../assets/images/favicon-16x16.png" sizes="16x16" />
    <link rel="icon" type="image/png" href="../../assets/images/favicon-128.png" sizes="128x128" />
    <?php
  } else {
    ?>
    <link rel="icon" type="image/png" href="../assets/images/favicon-196x196.png" sizes="196x196" />
    <link rel="icon" type="image/png" href="../assets/images/favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/png" href="../assets/images/favicon-32x32.png" sizes="32x32" />
    <link rel="icon" type="image/png" href="../assets/images/favicon-16x16.png" sizes="16x16" />
    <link rel="icon" type="image/png" href="../assets/images/favicon-128.png" sizes="128x128" />
    <?php
  }
?>
</head>
