<?php

include "connection.php";
session_start();

if (isset($_SESSION["arduino_admin"])) {

    if (isset($_GET["bannerId"])) {

        $bannerId = $_GET["bannerId"];

        $rs = Database::search("SELECT * FROM `banners` WHERE `banner_id`='$bannerId'");
        if ($rs->num_rows == 1) {

            $banner = $rs->fetch_assoc();

            unlink(($banner["path"]));

            Database::iud("DELETE FROM `banners` WHERE `banner_id`='$bannerId'");
            echo ("success");
        } else {
            echo ("Image not found!");
        }
    }
} else {
    echo ("Please login first!");
    exit();
}
