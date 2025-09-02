<?php

include "connection.php";
session_start();

if (!isset($_SESSION["arduino_user"])) {
    echo "You need to login first!";
    exit();
}

$userId = $_SESSION["arduino_user"]["id"];

$stockId = $_GET["stock"];
$qty = $_GET["qty"];

if (empty($stockId)) {
    echo "Invalid Stock";
} else if (empty($qty)) {
    echo "Quantity cannot be empty";
}else if(!is_numeric($qty)){
    echo "Invalid Qty, you can only enter a number value to your input";
} else if ($qty < 1) {
    echo "Quantity cannot be less than 1";
} else {

    $sRs = Database::search("SELECT * FROM `stock` WHERE `id` = '$stockId'");
    $sRow = $sRs->fetch_assoc();

    $availableQty = $sRow["qty"];

    $rs = Database::search("SELECT * FROM `cart` WHERE `user_id` = '$userId' AND `stock_id`='$stockId'");
    $num = $rs->num_rows;

    if ($num > 0) {

        $row = $rs->fetch_assoc();
        $cartId = $row["id"];

        $newQty = $row["qty"] + $qty;

        if ($availableQty >= $newQty) {
            Database::iud("UPDATE `cart` SET `qty`='$newQty' WHERE `id`='$cartId'");
            echo "success1";
        } else {
            echo "Quantity Exeeded!";
        }
    } else {
        if ($availableQty >= $qty) {
            Database::iud("INSERT INTO `cart`(`user_id`,`stock_id`,`qty`) VALUES ('$userId','$stockId','$qty')");
            echo "success2";
        } else {
            echo "Quantity Exeeded!";
        }
    }
}
