<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
<link href='https://fonts.googleapis.com/css?family=Raleway:400,500,700' rel='stylesheet' type='text/css'>

<!-- if page is in /movies/page.php then you need to backtrack for the css file -->
<?php 
  $pageurl = $_SERVER['PHP_SELF'];

  $page = substr($pageurl, strrpos($pageurl, '/') + 1);

  if (strpos($page, 'page.php') !== false) {
    ?>
    <link rel="stylesheet" type="text/css" href="../css/main.css">
    <link rel="icon" type="image/png" href="../assets/images/favicon-196x196.png" sizes="196x196" />
    <link rel="icon" type="image/png" href="../assets/images/favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/png" href="../assets/images/favicon-32x32.png" sizes="32x32" />
    <link rel="icon" type="image/png" href="../assets/images/favicon-16x16.png" sizes="16x16" />
    <link rel="icon" type="image/png" href="../assets/images/favicon-128.png" sizes="128x128" />
    <?php
  } else {
    ?>
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="icon" type="image/png" href="assets/images/favicon-196x196.png" sizes="196x196" />
    <link rel="icon" type="image/png" href="assets/images/favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/png" href="assets/images/favicon-32x32.png" sizes="32x32" />
    <link rel="icon" type="image/png" href="assets/images/favicon-16x16.png" sizes="16x16" />
    <link rel="icon" type="image/png" href="assets/images/favicon-128.png" sizes="128x128" />
    <?php
  }
?>