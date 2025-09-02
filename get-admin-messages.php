<?php

session_start();
include "connection.php";


if (isset($_SESSION["arduino_admin"])) {

    $userId = $_GET["user"];

    $rs = Database::search("SELECT * FROM `message` WHERE `sender`='$userId' OR `receiver`='$userId'");
    Database::iud("UPDATE `message` SET `status`='1' WHERE `sender`='$userId'");

    $messages = [];

    if ($rs->num_rows > 0) {
        while ($row = $rs->fetch_assoc()) {
            $messages[] = $row;
        }
    }

    echo json_encode($messages);
} else {
    header("Location:admin-signin.php");
}
