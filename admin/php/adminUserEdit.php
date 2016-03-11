<?php include '../includes/connection.php' ?>
<?php
  
  connect();

  $id = $_GET["id"];
  $fname = $_GET["f_name"];
  $lname = $_GET["l_name"];
  $url = $_GET["url"];
  $permissions = $_GET["permissions"];

  $query = "UPDATE users SET f_name = '".$fname."', l_name = '".$lname."', url_slug = '".$url."', permissions = ".$permissions." WHERE user_id = ".$id."";
  $run = mysql_query($query) or die(mysql_error());

  echo $fname;
?>