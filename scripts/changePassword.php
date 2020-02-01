<?php
session_start();

include_once 'dbh.inc.php';

// get password variables from form
$old_password = $_POST['old_password'];
$new_password = $_POST['new_password'];
$id = $_SESSION['id'];

// protect against sql injections
$old_password = htmlspecialchars(md5($connection->real_escape_string($_POST['old_password'])), ENT_QUOTES, 'UTF-8');
$new_password = htmlspecialchars(md5($connection->real_escape_string($_POST['new_password'])), ENT_QUOTES, 'UTF-8');

// prepare statements
$stmt = $connection->prepare('SELECT password FROM users WHERE id=? AND password=?');
$stmt->bind_param('ss', $id, $old_password);

$stmt->execute();

$result = $stmt->get_result();
$resultcheck = mysqli_num_rows($result);

// if there is a match update passwords
if ($resultcheck > 0) {
    $nstmt = $connection->prepare('UPDATE users SET password=? WHERE id=?');
    $nstmt->bind_param('ss', $new_password, $id);
    $nstmt->execute();
    exit("success");
} else {
    exit("failed");
}
