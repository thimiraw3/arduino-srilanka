<?php

session_start();
include "connection.php";

if (isset($_SESSION["arduino_user"])) {

    $id = $_SESSION["arduino_user"]["id"];
    $pid = $_POST["pid"];
    $rating = $_POST["rating"];
    $feed = $_POST["f"];

    if (empty($feed)) {
        echo "Please Enter your feedback to save your feedback";
    } else if (empty($pid)) {
        echo "An error occoured. Please try again later";
    } else {

        Database::iud("UPDATE `feedback` SET `rating`='" . $rating . "',`feedback`='" . $feed . "'
     WHERE `product_id`='" . $pid . "' AND `user_id`='" . $id . "'");

        echo ("success");
    }
}
