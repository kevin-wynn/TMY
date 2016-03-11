<?php

  include 'connection.php';

  connect();

  // this clears entire database
  $reset = "TRUNCATE TABLE users";
  $run = mysql_query($reset) or die(mysql_error());
  
  $user1 = "INSERT INTO `users` (`user_id`, `username`, `password`, `email`, `permissions`, `last_login`, `url_slug`, `f_name`, `l_name`)
            VALUES (1, 'kevin@kevin-wynn.com', '8b30638cb7bd30b7ce91ec75012664f56fb91155a0d2223711a4ab66673ca82c461d806a42fee11a1e0c8832b539329c49419b95b9b8dc86e2904be0387a821e', 'kevin@kevin-wynn.com', 300, '2015-10-02','kevinwynn', 'Kevin', 'Wynn');";

  $user2 = "INSERT INTO `users` (`user_id`, `username`, `password`, `email`, `permissions`, `last_login`, `url_slug`, `f_name`, `l_name`)
            VALUES (2, 'drone@tmy.com', '8b30638cb7bd30b7ce91ec75012664f56fb91155a0d2223711a4ab66673ca82c461d806a42fee11a1e0c8832b539329c49419b95b9b8dc86e2904be0387a821e', 'drone@tmy.com', 100, '2015-11-02','drone', 'Drone', 'User');";

  $user3 = "INSERT INTO `users` (`user_id`, `username`, `password`, `email`, `permissions`, `last_login`, `url_slug`, `f_name`, `l_name`)
            VALUES (3, 'keavurewyn@tmy.com', '8b30638cb7bd30b7ce91ec75012664f56fb91155a0d2223711a4ab66673ca82c461d806a42fee11a1e0c8832b539329c49419b95b9b8dc86e2904be0387a821e', 'keavurewyn@tmy.com', 200, '2015-12-02','keanu', 'Keanu', 'Weeves');";

  $user4 = "INSERT INTO `users` (`user_id`, `username`, `password`, `email`, `permissions`, `last_login`, `url_slug`, `f_name`, `l_name`)
            VALUES (4, 'tonyStark@tmy.com', '8b30638cb7bd30b7ce91ec75012664f56fb91155a0d2223711a4ab66673ca82c461d806a42fee11a1e0c8832b539329c49419b95b9b8dc86e2904be0387a821e', 'tonyStark@tmy.com', 100, '2016-01-02','tstark','Tony','Stark');";

  $run = mysql_query($user1) or die(mysql_error());
  $run = mysql_query($user2) or die(mysql_error());
  $run = mysql_query($user3) or die(mysql_error());
  $run = mysql_query($user4) or die(mysql_error());

?>