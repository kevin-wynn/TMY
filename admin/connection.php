<?php


function Connect()
  {
    $dbhost = "localhost";
    $dbuser = "root";
    $dbpass = "mariocart64";
    $dbname = "tmydb";

    $connect = mysql_connect($dbhost, $dbuser, $dbpass);
       if(! $connect )
       {
         die('Could not connect: ' . mysql_error());
       }	
    mysql_select_db($dbname);
   
    return $connect;
  }
 
?>