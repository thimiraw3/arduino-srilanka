<?php

include "connection.php";
session_start();

if (isset($_SESSION["arduino_admin"])) {

    $length = sizeof($_FILES);

    $imgPath = "resources/banners/" . uniqid() . "_" . $_FILES["bannerImg"]["name"];
    move_uploaded_file($_FILES["bannerImg"]["tmp_name"], $imgPath);

    Database::iud("INSERT INTO `banners`(`path`,`type`) VALUES('$imgPath','banner')");
    echo ("success");
} else {
    echo ("Please login first!");
    exit();
}
