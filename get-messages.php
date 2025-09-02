<?php

session_start();
include "connection.php";


if (isset($_SESSION["arduino_user"])) {

    $user = $_SESSION["arduino_user"]["id"];

    $rs = Database::search("SELECT * FROM `message` WHERE `sender`='$user' OR `receiver`='$user'");
    Database::iud("UPDATE `message` SET `status`='1' WHERE `receiver`='$user'");

    $messages = [];

    if ($rs->num_rows > 0) {
        while ($row = $rs->fetch_assoc()) {
            $messages[] = $row;
        }
    }

    echo json_encode($messages);
} else {
    header("Location:signin.php");
}
