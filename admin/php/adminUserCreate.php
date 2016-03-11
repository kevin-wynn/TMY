<?php include '../includes/connection.php' ?>
<?php
  
  connect();

  $count = mysql_query("SELECT * FROM users");
  $userId = mysql_num_rows($count);
  $userId = $userId+1;

  echo $userId . '<br>';

  $timezone = date_default_timezone_set('America/Los_Angeles');
  $date = date('Y-m-d');

  echo $date . '<br>';

  $fname = $_GET["f_name"];
  $lname = $_GET["l_name"];
  $url = $_GET["url"];
  $permissions = $_GET["permissions"];
  $email = $_GET["email"];
  $username= $_GET["username"];

  echo $fname . '<br>';
  echo $lname . '<br>';
  echo $url . '<br>';
  echo $permissions . '<br>';
  echo $email . '<br>';
  echo $username . '<br>';

  // Generate the reset key
  $resetkey = hash('sha512', $email);

  echo $resetket . '<br>';

  $query = "INSERT INTO users (
    user_id,
    username,
    password,
    email,
    permissions,
    last_login,
    url_slug,
    f_name,
    l_name
  ) VALUES (
    '$userId',
    '$username',
    '$resetkey',
    '$email',
    '$permissions',
    '$date',
    '$url',
    '$fname',
    '$lname'
  )";
  $run = mysql_query($query) or die(mysql_error());
?>