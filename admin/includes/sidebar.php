<?php
  session_start();
  if(!isset($_SESSION['user_id'])) {
    $message = 'You must be logged in to access this page';
  }
  else {
    try {
      include 'credentials.php';
      $dbh = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
      $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $stmt = $dbh->prepare("SELECT username FROM users WHERE user_id = :user_id");
      $stmt->bindParam(':user_id', $_SESSION['user_id'], PDO::PARAM_INT);
      $stmt->execute();
      $username = $stmt->fetchColumn();
    }
    catch (Exception $e) {
      $message = 'We are unable to process your request. Please try again later"';
    }
  }

?>
<?php if($username == true) { ?>
  <div class="logout">
     <form class="logout-form" action="logout.php" method="post">
       <input class="logout-submit" type="submit" value="Log Out" /> <i class="fa fa-sign-out"></i>
     </form>
  </div>
<?php }; ?>

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
        <li id="dashboard"><a href="<?php echo dirname($_SERVER['PHP_SELF']);?>/../index.php"><i class="fa fa-tachometer"></i> Dashboard</a></li>
        <li id="sidebar-movies"><a href="<?php echo dirname($_SERVER['PHP_SELF']);?>/../movies.php"><i class="fa fa-film"></i> Movies</a></li>
        <li id="sidebar-writer"><a href="<?php echo dirname($_SERVER['PHP_SELF']);?>/../writer.php"><i class="fa fa-pencil"></i> Writer</a></li>
        <li id="sidebar-rating"><a href="<?php echo dirname($_SERVER['PHP_SELF']);?>/../rating.php"><i class="fa fa-star"></i> Rating</a></li>
        <li id="sidebar-users"><a href="<?php echo dirname($_SERVER['PHP_SELF']);?>/../users.php"><i class="fa fa-users"></i> Users</a></li>
      <?php } else { ?>
        <li id="sidebar-dashboard"><a href="<?php echo dirname($_SERVER['PHP_SELF']);?>/index.php"><i class="fa fa-tachometer"></i> Dashboard</a></li>
        <li id="sidebar-movies"><a href="<?php echo dirname($_SERVER['PHP_SELF']);?>/movies.php"><i class="fa fa-film"></i> Movies</a></li>
        <li id="sidebar-writer"><a href="<?php echo dirname($_SERVER['PHP_SELF']);?>/writer.php"><i class="fa fa-pencil"></i> Writer</a></li>
        <li id="sidebar-rating"><a href="<?php echo dirname($_SERVER['PHP_SELF']);?>/rating.php"><i class="fa fa-star"></i> Rating</a></li>
        <li id="sidebar-users"><a href="<?php echo dirname($_SERVER['PHP_SELF']);?>/users.php"><i class="fa fa-users"></i> Users</a></li>
      <?php }; ?>
  </ul>
</div>
<!-- /#sidebar-wrapper -->