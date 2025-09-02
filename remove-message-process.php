<?php
include "connection.php";

if (!isset($_GET["id"])) {
    echo "Invalid request";
} else {

    $msgId = $_GET["id"];

    $rs = Database::search("SELECT * FROM `customer_questions` WHERE `id`='$msgId'");
    $num = $rs->num_rows;

    if ($num > 0) {
        Database::iud("DELETE FROM `customer_questions` WHERE `id`='$msgId'");
        echo "success";
    } else {
        echo "Message not found!";
    }
}
