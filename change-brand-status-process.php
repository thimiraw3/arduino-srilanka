<?php

include "connection.php";

if (isset($_GET["id"])) {
    $id = $_GET["id"];

    $rs = Database::search("SELECT * FROM `brand` WHERE `brand_id`='$id' ");
    $num = $rs->num_rows;

    if ($num > 0) {
        $row = $rs->fetch_assoc();

        $status = 0;
        if ($row["status"] == 0) {
            $status = 1;
        }

        Database::iud("UPDATE `brand` SET `status`='$status' WHERE `brand_id`='$id'");
        echo ("success");
    } else {
        echo ("Brand not found!");
    }
} else {
    echo "Could not find brand ID";
}
