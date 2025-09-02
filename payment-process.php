<?php

include "connection.php";
session_start();

$user = $_SESSION["arduino_user"];
$userId = $user["id"];

$error = '';

$stockList = [];
$qtyList = [];

if (isset($_POST["cart"]) && $_POST["cart"] == "true") {

    $rs = Database::search("SELECT * FROM `cart` WHERE `user_id`='$userId'");
    $num = $rs->num_rows;

    for ($i = 0; $i < $num; $i++) {
        $row = $rs->fetch_assoc();

        $stockList[] = $row["stock_id"];
        $qtyList[] = $row["qty"];
    }
} else {

    $stockList[] = $_POST["stockId"];
    $qtyList[] = $_POST["qty"];
}

$merchantId = "Your ID";
$merchantSecret = "Your Secret";
$items = [];
$netTotal = 0;
$currency = "LKR";
$orderId = uniqid();

for ($x = 0; $x < sizeof($stockList); $x++) {

    $stockRs = Database::search("SELECT * FROM `stock_view` WHERE `stock_id`='" . $stockList[$x] . "'");
    $stock = $stockRs->fetch_assoc();

    $stockQty = $stock["qty"];

    if ($stockQty >= $qtyList[$x]) {
        $items[] = $stock["name"];

        $discounted_price = intval($stock["price"]) - (intval($stock["price"]) * intval($stock["discount"])) / 100;

        $netTotal += intval($discounted_price) * intval($qtyList[$x]);
    } else {
        $error = "Insufficient Quantity";
    }
}

$deliveryFeeRs = Database::search("SELECT * FROM `user_address` INNER JOIN `destrict` ON `user_address`.`destrict_destrict_id`= `destrict`.`destrict_id`
INNER JOIN `province` ON `destrict`.`province_province_id`=`province`.`province_id` WHERE `user_id`='$userId'");

$delivery_num = $deliveryFeeRs->num_rows;

$deliveryFee = 0;

if ($delivery_num > 0) {
    $delivery = $deliveryFeeRs->fetch_assoc();
    $deliveryFee = $delivery["delivery_fee"];
}
$netTotal += $deliveryFee;

$hash = strtoupper(
    md5(
        $merchantId .
            $orderId .
            number_format($netTotal, 2, '.', '') .
            $currency .
            strtoupper(md5($merchantSecret))
    )
);

$paymet = [];
$paymet["sandbox"] = true;
$paymet["merchant_id"] = $merchantId;
$paymet["return_url"] = "http://localhost/onlinestore";
$paymet["cancel_url"] = "http://localhost/onlinestore";
$paymet["notify_url"] = "http://localhost/onlinestore/notify";
$paymet["order_id"] = $orderId;
$paymet["items"] = implode(", ", $items);
$paymet["amount"] = number_format($netTotal, 2, '.', '');
$paymet["currency"] = $currency;
$paymet["hash"] = $hash;
$paymet["first_name"] = $user["fname"];
$paymet["last_name"] = $user["lname"];
$paymet["email"] = $user["email"];
$paymet["phone"] = $user["mobile"];
$paymet["delivery_fee"] = $deliveryFee;

$addressRs = Database::search("SELECT * FROM `user_address` WHERE `user_id`='$userId'");
$num = $addressRs->num_rows;

if ($num > 0) {
    $address = $addressRs->fetch_assoc();
    $paymet["address_no"] = $address["no"];
    $paymet["address"] = $address["line1"] . " " . $address["line2"];
    $paymet["city"] = $address["city"];
    $paymet["p_code"] = $address["postal_code"];
    $paymet["destrict"] = $address["destrict_destrict_id"];
    $paymet["country"] = "Sri Lanka";
} else {
    $error = "You have to update your user-profile and add your billing details first!";
}

$json = [];

if (empty($error)) {

    $json["status"] = "success";
    $json["payment"] = $paymet;
} else {

    $json["status"] = "error";
    $json["error"] = $error;
}

echo json_encode($json);
