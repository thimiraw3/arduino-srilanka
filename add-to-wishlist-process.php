<?php

include "connection.php";
session_start();

if (!isset($_SESSION["arduino_user"])) {
    echo "You need to login first!";
    exit();
}

$userId = $_SESSION["arduino_user"]["id"];
$stockId = $_GET["stock"];

if (empty($stockId)) {
    echo "Invalid Stock";
} else {

    $rs = Database::search("SELECT * FROM `wishlist` WHERE `user_id` = '$userId' AND `stock_id`='$stockId'");
    $num = $rs->num_rows;

    if ($num > 0) {

        echo "Product already added to the wishlist";

    } else {
        
        Database::iud("INSERT INTO `wishlist`(`stock_id`,`user_id`) VALUES('$stockId','$userId')");
        echo "success";

    }
}
