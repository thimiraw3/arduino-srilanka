<?php

session_start();
include "connection.php";

if (isset($_SESSION["arduino_user"])) {

    $userId = $_SESSION["arduino_user"]["id"];
    $pid = $_POST["pid"];
    $rating = intval($_POST['rating']);
    $feed = $_POST["f"];

    if (empty($feed)) {
        echo "Please Enter your feedback to save your feedback";
    } else if (empty($pid)) {
        echo "An error occoured. Please try again later";
    } else {

        $d = new DateTime();
        $tz = new DateTimeZone("Asia/Colombo");
        $d->setTimezone($tz);
        $date = $d->format("Y-m-d H:i:s");

        Database::iud("INSERT INTO `feedback` (`rating`,`date`,`feedback`,`product_id`,`user_id`) VALUES
     ('" . $rating . "','" . $date . "','" . $feed . "','" . $pid . "','" . $userId . "')");

        echo ("success");
    }
}
