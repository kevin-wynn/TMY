<?php include '../includes/connection.php' ?>
<?php
  
  connect();

  $count = mysql_query("SELECT * FROM users");
  $userId = mysql_num_rows($count);
  $userId = $userId+1;

  $timezone = date_default_timezone_set('America/Los_Angeles');
  $date = date('Y-m-d');

  $fname = $_GET["f_name"];
  $lname = $_GET["l_name"];
  $url = $_GET["url"];
  $permissions = $_GET["permissions"];
  $email = $_GET["email"];
  $username= $_GET["username"];
  $resetkey = hash('sha512', $email);

  $query = "INSERT INTO users (
    user_id,
    username,
    password,
    email,
    permissions,
    last_login,
    url_slug,
    f_name,
    l_name,
    headshot,
    signup_date
  ) VALUES (
    '$userId',
    '$username',
    '$resetkey',
    '$email',
    '$permissions',
    '$date',
    '$url',
    '$fname',
    '$lname',
    'NULL',
    '$date'
  )";

  $run = mysql_query($query);

  if (!$run) {
    die('Failure');
  } else {
    echo 'Created';
  }
?>