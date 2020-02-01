<?php
session_start();

require_once "functions.php";

// get csrf key from hidden form
$csrf_key = $_POST['csrf_key'];

// if csrf key isnt empty check if session key is equal to form key
if (!empty($csrf_key)) {
    if (hash_equals($_SESSION['csrf_key'], $csrf_key)) {
        if (isset($_POST['email'])) {

            require_once 'dbh.inc.php';

            $email = $connection->real_escape_string($_POST['email']);

            // prepare sql statement
            $stmt = $connection->prepare('SELECT id FROM users WHERE email=?');
            $stmt->bind_param('s', $email);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows > 0) {
                $token = generateNewString();

                $stmt = $connection->prepare('UPDATE users SET token=?, tokenExpire=DATE_ADD(NOW(), INTERVAL 5 MINUTE)WHERE email=?');
                $stmt->bind_param('ss', $token, $email);
                $stmt->execute();

                // send email to user with reset password link
                $to = $email;
                $subject = "Reset your password on PhoKingNais.com";
                $message = "
                <html> 
                <body> 
                <p>Hi,</p><br>
                <p>In order to reset your password, please click <a href='https://agile152.science.uva.nl/scripts/resetPassword.php?email=$email&token=$token'>here.</a></p><br><br>
                <p>Kind regards,</p>
                <p>PhoKingNais</p>
                </body>
                </html>";
                $headers[] = 'From: PhoKingNais <no_reply@phokingnais.com>';
                $headers[] = 'MIME-Version: 1.0';
                $headers[] = 'Content-type: text/html; charset=iso-8859-1';

                // return status msg
                if (mail($to, $subject, $message, implode("\r\n", $headers)))
                    exit(json_encode(array("status" => 1, "msg" => 'Please Check Your Email Inbox!')));
                else
                    exit(json_encode(array("status" => 0, "msg" => 'Something Wrong Just Happened! Please try again!')));
            } else
                exit(json_encode(array("status" => 0, "msg" => 'Please Check Your Inputs!')));
        }
    } else {
        exit("ERROR: keys dont match!");
    }
} else {
    exit("ERROR: no key found!");
}
