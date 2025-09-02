<?php

include "connection.php";
session_start();
$userId = $_SESSION["arduino_user"]["id"];

$errors = [];

if (isset($_POST["payment"]) && isset($_SESSION["arduino_user"])) {

    $payment = json_decode($_POST["payment"], true);

    $date = new DateTime();
    $tz = new DateTimeZone("Asia/Colombo");
    $date->setTimezone($tz);

    $time = $date->format("Y-m-d H:i:s");

    Database::iud("INSERT INTO `invoice`(`invoice_id`,`date_time`,`total`,`user_id`,`order_status`,`delivery_fee`) 
    VALUES ('" . $payment["order_id"] . "','$time','" . $payment["amount"] . "', '$userId','1','" . $payment["delivery_fee"] . "')");

    $insertId = Database::$connection->insert_id;

    Database::iud("INSERT INTO `order_address`(`invoice_id`,`no`,`address`,`postal_code`,`city`,`destrict_destrict_id`)
    VALUES('$insertId','" . $payment["address_no"] . "','" . $payment["address"] . "','" . $payment["p_code"] . "','" . $payment["city"] . "','" . $payment["destrict"] . "')");

    $stockRs = Database::search("SELECT * FROM `stock` WHERE `id`='" . $payment['stockId'] . "'");
    $stock = $stockRs->fetch_assoc();

    if ($stock["qty"] >= $payment["qty"]) {

        Database::iud("INSERT INTO `invoice_items`(`qty`,`price`,`invoice_id`,`stock_id`) VALUES ('" . $payment["qty"] . "',
        '" . $stock["price"] . "','$insertId','" . $stock["id"] . "')");

        $newQty = $stock["qty"] - $payment["qty"];
        Database::iud("UPDATE `stock` SET `qty`='$newQty' WHERE `id`='" . $payment["stockId"] . "'");
    } else {
        $errors[0] = "Insufficient Quantity!";
    }
} else {
    $errors[0] = "Invalid Request";
}

$json = [];

if (empty($errors)) {
    $json["status"] = "success";
    $json["ohId"] = $insertId;
} else {
    $json["status"] = "error";
    $json["ohId"] = $errors[0];
}

echo json_encode($json);
