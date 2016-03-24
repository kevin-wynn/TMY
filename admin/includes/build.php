<?php include 'credentials.php'; ?>
<?php include 'db_reset.php'; ?>

 <?php
  function build($dbuser, $dbpass, $dbname) {
    // these are defined for local and probably wont change
    $dbhost = "localhost";

    // connect to database based on submitted user/pass
    $connect = mysql_connect($dbhost, $dbuser, $dbpass);
       if(! $connect )
       {
         die('Could not connect: ' . mysql_error());
       }
    
    $createDBrun = "CREATE DATABASE " . $dbname;
    
    $createDB = mysql_query($createDBrun);

    // select tmydb
    mysql_select_db($dbname);
    
    // build table for credentials
    $buildCredDB = "CREATE TABLE IF NOT EXISTS credentials (
      dbuser varchar(255),
      dbpass varchar(255),
      dbname varchar(255),
      dbhost varchar(255)
    )";

    $run = mysql_query($buildCredDB) or die(mysql_error());
    
    $clearfirst = "TRUNCATE TABLE credentials";
    
    $clear = mysql_query($clearfirst) or die(mysql_error());

    // insert credentials into columns
    $creds = "INSERT IGNORE INTO credentials (
      dbhost,
      dbname,
      dbuser,
      dbpass
    ) VALUES (
      'localhost',
      'tmydb',
      '$dbuser',
      '$dbpass'
    )";

    $setCreds = mysql_query($creds);
    
    $config_file = 'credentials.php';
    $handle = fopen($config_file, 'w') or die('Cannot open file:  '.$config_file);
    $data = '<?php $dbuser = ' . $dbuser . '; $dbpass = ' . $dbpass . '; $dbhost = ' . $dbhost . '; $dbname = ' . $dbname . '?>';
    fwrite($handle, $data);
    
  }

  dbSeed();
?>