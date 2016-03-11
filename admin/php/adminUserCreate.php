<?php include '../includes/connection.php' ?>
<?php
  
  connect();

  $count = mysql_query("SELECT * FROM users");
  $userId = mysql_num_rows($count);
  $userId + 1;

  $fname = $_GET["f_name"];
  $lname = $_GET["l_name"];
  $url = $_GET["url"];
  $permissions = $_GET["permissions"];

  $query = "INSERT IGNORE INTO users VALUES(f_name = '".$fname."', l_name = '".$lname."', url_slug = '".$url."', permissions = ".$permissions.", user_id = ".$userId.")";
  $run = mysql_query($query) or die(mysql_error());

  echo $fname;
?>