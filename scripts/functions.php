<?php
function generateNewString($len = 10)
{
    $token = "poiuztrewqasdfghjklmnbvcxy1234567890";
    $token = str_shuffle($token);
    $token = substr($token, 0, $len);

    return $token;
}

function redirectToLoginPage()
{
    header('Location: sign_in.php');
    exit();
}

function generateNewID($len = 15)
{
    $id = "poiuztrewqasdfghjklmnbvcxy1234567890";
    $id = str_shuffle($id);
    $id = substr($id, 0, $len);

    return $id;
}

function findOrders()
{
    include_once 'dbh.inc.php';

    $userID = $_SESSION['id'];

    $stmt = $connection->prepare('SELECT * FROM reservations WHERE user_id=? ORDER BY timestamp');
    $stmt->bind_param('s', $userID);

    $stmt->execute();

    $result = $stmt->get_result();

    return $result;
}

function findLastOrders()
{
    include_once 'dbh.inc.php';

    $userID = $_SESSION['id'];

    $stmt = $connection->prepare('SELECT * FROM reservations WHERE user_id=? ORDER BY id DESC');
    $stmt->bind_param('s', $userID);

    $stmt->execute();

    $result = $stmt->get_result();

    return $result;
}

function findAllOrders()
{
    include 'dbh.inc.php';

    $stmt = $connection->prepare('SELECT * FROM reservations ORDER BY timestamp');
    $stmt->execute();
    $result = $stmt->get_result();

    return $result;
}

function findCustomer($userID)
{
    include 'dbh.inc.php';

    $stmt = $connection->prepare('SELECT firstName, lastName FROM users WHERE id=?');
    $stmt->bind_param('s', $userID);
    $stmt->execute();
    $customer = $stmt->get_result();
    $customerList = $customer->fetch_array();

    return $customerList;
}
