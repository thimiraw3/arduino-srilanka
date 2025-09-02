<?php

include "connection.php";
session_start();

$email = $_POST["email"];
$password = $_POST["password"];

if (empty($email)) {
    echo ("Enter your email address");
} else if (empty($password)) {
    echo ("Enter your password");
} else {
    $result = Database::search("SELECT * FROM `user` WHERE `email`='" . $email . "' AND `password`='" . $password . "' AND `user_type_id`='1'");

    $num = $result->num_rows;

    if ($num == 1) {
        $data = $result->fetch_assoc();
        $_SESSION["arduino_admin"] = $data;
        echo ("success");
    } else {
        echo ("Invalid email or password");
    }
}
