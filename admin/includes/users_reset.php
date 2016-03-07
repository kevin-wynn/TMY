<?php

  include 'connection.php';

  connect();

  // this clears entire database
  $reset = "TRUNCATE TABLE users";
  $run = mysql_query($reset) or die(mysql_error());
  
  $user1 = "INSERT INTO `users` (`user_id`, `username`, `password`, `email`, `permissions`)
            VALUES (1, 'kevin', '31700c2c6cd98ec38c0e3ecb966fd5245033ac37', 'kevin@kevin-wynn.com', 300);";

  $user2 = "INSERT INTO `users` (`user_id`, `username`, `password`, `email`, `permissions`)
            VALUES (2, 'drone', '1430fd26ed07651f08ab03098c8e6745701abf6a', 'drone@tmy.com', 100);";

  $user3 = "INSERT INTO `users` (`user_id`, `username`, `password`, `email`, `permissions`)
            VALUES (3, 'keavurewyn', '4884516415dcc4c4eb5b34719db9f8b8dfe3f531', 'keavurewyn@tmy.com', 200);";

  $user4 = "INSERT INTO `users` (`user_id`, `username`, `password`, `email`, `permissions`)
            VALUES (4, 'tonyStark', '33b99ef638b0c180e41e1aece5e3ae7085becedc', 'tonyStark@tmy.com', 100);";

  $run = mysql_query($user1) or die(mysql_error());
  $run = mysql_query($user2) or die(mysql_error());
  $run = mysql_query($user3) or die(mysql_error());
  $run = mysql_query($user4) or die(mysql_error());

?>