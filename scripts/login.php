<?php
session_start();

include_once 'dbh.inc.php';
// get csrf key from hidden form
$csrf_key = $_POST['csrf_key'];

// if csrf key isnt empty check if session key is equal to form key
if (!empty($csrf_key)) {
    if (hash_equals($_SESSION['csrf_key'], $csrf_key)) {
        $email = $_POST['emailPHP'];
        $password = $_POST['passwordPHP'];

        // prevent sql injections
        $email = htmlspecialchars($connection->real_escape_string($_POST['emailPHP']), ENT_QUOTES, 'UTF-8');
        $password = htmlspecialchars(md5($connection->real_escape_string($_POST['passwordPHP'])), ENT_QUOTES, 'UTF-8');

        $stmt = $connection->prepare('SELECT * FROM users WHERE email=? AND PASSWORD=?');
        $stmt->bind_param('ss', $email, $password);

        $stmt->execute();

        $result = $stmt->get_result();
        $resultcheck = mysqli_num_rows($result);

        // get results from database if user exists
        if ($resultcheck > 0) {
            while ($row = $result->fetch_assoc()) {
                $_SESSION['loggedIN'] = '1';
                $_SESSION['id'] = $row['id'];
                $_SESSION['firstName'] = $row['firstName'];
                $_SESSION['lastName'] = $row['lastName'];
                $_SESSION['email'] = $email;
                $_SESSION['role_id'] = $row['role_id'];
                $_SESSION['activationCode'] = $row['activationCode'];
                exit("success");
            }
        } else {
            exit("failed");
        }
    } else {
        exit("ERROR: csrf key not equal");
    }
}
exit('failed');
