<?php
  $to = "kevin@thismovieyear.com";
  $subject = "Confirm your email for TMY";
  $message = "Confirm your email for TMY";
  $from = "server@thismovieyear.com";
  $headers = "From:" . $from;
  mail($to,$subject,$message,$headers);

?>