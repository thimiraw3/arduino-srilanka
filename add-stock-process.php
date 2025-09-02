<?php

include "connection.php";

$product = $_POST["product"];
$qty = $_POST["qty"];
$price = $_POST["price"];
$warenty = $_POST["warenty"];
$discount = $_POST["discount"];

if ($product == "0") {
    echo ("Please select a Product");
} else if (empty($qty)) {
    echo ("Please enter the quantity");
} else if ($qty < 1 || !is_numeric($qty)) {
    echo ("Invalid Qty");
} else if (empty($price)) {
    echo ("Please enter the price");
} else if ($price < 1 || !is_numeric($price)) {
    echo ("Invalid price");
} else {

    if(empty($discount)){
        $discount = "none";
    }

    if(empty($warenty)){
        $warenty = "none";
    }

    $rs = Database::search("SELECT * FROM `stock` WHERE `product_id`='$product' AND `price`='$price' AND `warenty`='$warenty' AND `discount`='$discount'");
    $num = $rs->num_rows;

    if ($num > 0) {
        $row = $rs->fetch_assoc();
        $newQty = $row["qty"] + $qty;

        Database::iud("UPDATE `stock` SET `qty`='$newQty' WHERE `id`='" . $row["id"] . "'");
    } else {

        Database::iud("INSERT INTO `stock`(`product_id`,`price`,`qty`,`warenty`,`discount`) VALUES('$product','$price','$qty','$warenty','$discount')");
    }
    echo ("success");
}
