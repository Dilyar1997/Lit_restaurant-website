<?php
session_start();

// get csrf key from form
$csrf_key = htmlspecialchars($_POST['csrf_key'], ENT_QUOTES, 'UTF-8');

include_once 'dbh.inc.php';
include_once 'functions.php';

// if csrf key isnt empty check if session key is equal to form key
if (!empty($csrf_key)) {
    if (hash_equals($_SESSION['csrf_key'], $csrf_key)) {

        // generate new user id
        $user_id = generateNewID();

        // get info from form and prevent sql injections
        $first_name = htmlspecialchars($connection->real_escape_string($_POST['first_name']), ENT_QUOTES, 'UTF-8');
        $last_name = htmlspecialchars($connection->real_escape_string($_POST['last_name']), ENT_QUOTES, 'UTF-8');
        $email = htmlspecialchars($connection->real_escape_string($_POST['email']), ENT_QUOTES, 'UTF-8');
        $password = htmlspecialchars(md5($connection->real_escape_string($_POST['password'])), ENT_QUOTES, 'UTF-8');
        $token = 0;
        $tokenExpire = date("Y-m-d");
        $role_id = 4;
        $activationCode = uniqid();

        // prepare sql statement
        if ($stmt = $connection->prepare('SELECT id FROM users WHERE email=?')) {
            $stmt->bind_param('s', $email);
            $stmt->execute();
            $stmt->store_result();

            // exit if email already exists
            if ($stmt->num_rows > 0) {
                exit("failed");
            } else {
                // else create new user in database
                if ($stmt = $connection->prepare('INSERT INTO users (id, firstName, lastName, email, password, role_id, token, tokenExpire, activationCode) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)')) {
                    $stmt->bind_param('sssssisss', $user_id, $first_name, $last_name, $email, $password, $role_id, $token, $tokenExpire, $activationCode);
                    $stmt->execute();

                    // create account activation link
                    $activate_link = 'https://agile152.science.uva.nl/activation.php?email=' . $email . '&code=' . $activationCode;

                    // send email to user with account activation link
                    $to = $email;
                    $subject = "Account Activation Required";
                    $message = '
                    <html> 
                    <body> 
                    <p>Hi, ' . $first_name . '</p><br>
                    <p>Please click the following link to activate your account: <a href="' . $activate_link . '">' . $activate_link . '</a></p>
                    <br><br>
                    <p>Kind regards,</p>
                    <p>PhoKingNais</p>
                    </body>
                    </html>';
                    $headers[] = 'From: PhoKingNais <no_reply@phokingnais.com>';
                    $headers[] = 'MIME-Version: 1.0';
                    $headers[] = 'Content-type: text/html; charset=iso-8859-1';

                    mail($to, $subject, $message, implode("\r\n", $headers));

                    echo 'Please check your email to activate your account!';

                    exit("success");
                } else {
                    exit("failed");
                }
            }
        } else {
            exit("failed");
        }
    } else {
        exit("failed");
    }
} else {
    exit("ERROR: csrf key not equal");
}
