<?php

include "connection.php";

$stock_id = $_POST["stock"];
$warenty = $_POST["warenty"];
$discount = $_POST["discount"];

if (empty($warenty)) {
    $warenty = "none";
}

if (empty($discount)) {
    $discount = "none";
}

$rs = Database::search("SELECT * FROM `stock` WHERE `id` ='$stock_id'");
$num = $rs->num_rows;

if ($num > 0) {

    Database::iud("UPDATE `stock` SET `warenty`='$warenty',`discount`='$discount' WHERE `id`='$stock_id'");
    echo ("success");
} else {

    echo ("Stock Does not exists.");
}
