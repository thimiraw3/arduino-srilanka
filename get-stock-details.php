<?php

include "connection.php";

$id = $_GET["stock_id"];

if (!empty($id)) {

    $rs = Database::search("SELECT `stock_id`,`product_id`,`qty`,`price`,`warenty`,`discount` FROM `stock_view` WHERE `stock_id`='$id'");
    $num = $rs->num_rows;

    if ($num > 0) {
        $row = $rs->fetch_assoc();
        echo (json_encode($row));
    }
}
