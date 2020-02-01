<?php
require_once "functions.php";

if (isset($_GET['email']) && isset($_GET['token'])) {

    require_once 'dbh.inc.php';

    // prevent sql injection
    $email = htmlspecialchars($connection->real_escape_string($_GET['email']), ENT_QUOTES, 'UTF-8');
    $token = htmlspecialchars($connection->real_escape_string($_GET['token']), ENT_QUOTES, 'UTF-8');

    // prepare sql statement
    $stmt = $connection->prepare("SELECT id FROM users WHERE email=? AND token=? AND token<>'' AND tokenExpire > NOW()");
    $stmt->bind_param('ss', $email, $token);
    $stmt->execute();
    $stmt->store_result();

    // if user exists generate new password
    if ($stmt->num_rows > 0) {
        $newPassword = generateNewString();
        $newPasswordEncrypted = md5($newPassword);

        // update database with new password
        $stmt = $connection->prepare("UPDATE users SET token='', password=? WHERE email='$email'");
        $stmt->bind_param('s', $newPasswordEncrypted);
        $stmt->execute();

        // print new password to user
        echo "Your New Password Is $newPassword<br><a href='https://agile152.science.uva.nl/sign_in.php'>Click Here To Sign In</a>";
    } else
        header('location: ../sign_in.php');
} else {
    header('location: ../sign_in.php');
}
