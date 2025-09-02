<?php

include "connection.php";

if (empty($_POST["invoiceId"])) {
    echo "Can't find the invoice id";
} else if ($_POST["status"] == 0) {
    echo "Please select status to continue";
} else {

    $invoiceId = $_POST["invoiceId"];
    $status = $_POST["status"];

    $rs = Database::search("SELECT * FROM `invoice` WHERE `id`='$invoiceId' ");
    $num = $rs->num_rows;

    if ($num > 0) {
        $row = $rs->fetch_assoc();

        Database::iud("UPDATE `invoice` SET `order_status`='$status' WHERE `id`='$invoiceId'");
        echo ("success");
    } else {
        echo ("Invoice not found!");
    }
}
