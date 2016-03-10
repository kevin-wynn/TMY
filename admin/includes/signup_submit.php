<?php
    // Connect to MySQL
    include 'credentials';

    try {
      $conn = new PDO("mysql:host={$dbhost};dbname={$dbname};charset=utf8", $dbuser, $dbpass);
    }
    catch(PDOException $ex) { 
        $msg = "Failed to connect to the database"; 
    }

    // Was the form submitted?
    if (isset($_POST["email"])) {
	
      // Harvest submitted e-mail address - front end checks for email validation but lets check again anyways
      if (filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $email = $_POST["email"];
      }else{
        echo "email is not valid";
        exit;
      };

      // Check to see if a user exists with this e-mail
//      $query = $conn->prepare('SELECT email FROM users WHERE email = :email');
//      $query->bindParam(':email', $email);
//      $query->execute();
//      $userExists = $query->fetch(PDO::FETCH_ASSOC);
//      $conn = null;
//
//      if ($userExists["email"]) {
//
//        // Want to move this to the front end check so its not changing pages
//        echo "This email already exists";
//
//      } else {

        // Create a unique salt. This will never leave PHP unencrypted.
        $salt = "69#77234020$20134230942356";

        // Create the unique user password reset key
        $password = hash('sha512', $email);

        // Create a url which we will direct them to reset their password
        $pwrurl = "http://localhost/~kevinwynn/TMY/admin/reset_password.php?q=".$password;
      
        $message = '<table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" id="bodyTable" style="background:#3e3a37;">
                    <tr>
                        <td align="center" valign="top">
                            <table border="0" cellpadding="20" cellspacing="0" width="600" id="emailContainer" style="background:#ffffff; margin-top:50px; margin-bottom: 50px;"> 
                                <tr>
                                    <td align="center" valign="top" style="font-family: Verdana, Geneva, sans-serif;">
                                     <img src="http://thismovieyear.com/email_resources/tmy_emailheader.png" width="600">
                                      <h1 style="font-size:28px;font-weight:500;line-height:26px;color:#3e3a37;">WELCOME</h1>
                                      <p style="font-size:18px;font-weight:300;line-height:26px;color:#3e3a37;">Glad to have you on board, to get started just click the link to set up your password.</p>
                                      <p style="font-size: 18px;font-weight:300;line-height:26px;color:#3e3a37;"><a style="color:#59ABE3;text-decoration:none;" href='. $pwrurl .'>SET UP MY PASSWORD</a></p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>';

        // Mail them their key
        $to = $email;
        $subject = "Confirm your email for TMY";
        $from = "server@thismovieyear.com";
        $headers = "From:" . $from;
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
      
        mail($to,$subject,$message,$headers);
        
        echo "Your password recovery key has been sent to your e-mail address. <br>" . $password;
//      };
    };
    
//  header( 'Location: ' . dirname($_SERVER['PHP_SELF']) . '/../' ); 
?>