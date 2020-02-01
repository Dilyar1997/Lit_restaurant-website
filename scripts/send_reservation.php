<?php
session_start();

include_once 'dbh.inc.php';

$userID = $_SESSION["id"];
$date_time = $_POST["date_time"];
$people = $_POST["people"];
$location = $_POST["location"];
$menu_item = $_POST["menu"];

$sql = "INSERT INTO reservations (user_id, timestamp, people_amount, location)
          VALUES ('$userID', '$date_time', $people, '$location')";

if ($connection->query($sql)) {
  echo "reservation placed";
  $reservation_id = $connection->insert_id;
  $sql = "INSERT INTO reservation_product (reservation_id, product_id, amount)
            VALUES ($reservation_id, $menu_item, $people)";
  if ($connection->query($sql)) {
    echo "reservation_product placed";
    mysqli_close($connection);
    exit("success");
  } else {
    echo "Error: " . $sql . "<br>" . $connection->error;
    mysqli_close($connection);
    exit("failed");
  }
} else {
  echo "Error: " . $sql . "<br>" . $connection->error;
  mysqli_close($connection);
  exit("failed");
}
