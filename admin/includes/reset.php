<?php
  // Connect to MySQL
  include 'credentials';
  include 'connection.php';

  connect();

  // Was the form submitted?
  if (isset($_POST["ResetPasswordForm"])) {
    // Gather the post data
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirmpassword = $_POST["confirmpassword"];
    $hash = $_POST["q"];
    
    $hash = str_replace("'", "", $hash);

    // Use the same salt from the forgot_password.php file
    $salt = "69#77234020$20134230942356";

    // Generate the reset key
    $resetkey = hash('sha512', $email);

      // Does the new reset key match the old one?
      if ($resetkey == $hash){
        
        if ($password == $confirmpassword){
          //has and secure the password
          $password = hash('sha512', $salt.$password);
          
            $userExists = "SELECT username FROM users WHERE email = '".$email."'";
            $findUser = mysql_query($userExists) or die(mysql_error());
          
            echo mysql_num_rows($findUser);
          
            if(mysql_num_rows($findUser)>=1) {
              // Update the user's password
              $query = "UPDATE users SET password = '".$password."' WHERE email = '".$email."'";
              $run = mysql_query($query) or die(mysql_error());
              
              echo "Your password has been successfully reset.";
            } else {
              // Create User
              $count = "SELECT * FROM users";
              $user_id = mysql_query($count) or die(mysql_error());
              $user_id = mysql_num_rows($user_id) + 1;
            
              $query = "INSERT INTO users (user_id, username, password, email, permissions) VALUES ('".$user_id."', '".$email."', '".$password."', '".$email."', 100);";
              $run = mysql_query($query) or die(mysql_error()); 
              
              echo 'User created with new password';
            }
        }
        else
          echo "Your password's do not match.";
      }
      else
        echo "Your password reset key is invalid. <br> reset key= " . $resetkey . '<br>hash = ' . $hash;
  }

?>
