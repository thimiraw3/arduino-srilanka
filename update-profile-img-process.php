<?php

include "connection.php";
session_start();

if (isset($_SESSION["arduino_user"])) {

    $length = sizeof($_FILES);

    if ($length > 0) {

        $uid = $_SESSION["arduino_user"]["id"];

        $rs = Database::search("SELECT * FROM `user` WHERE `id`='$uid'");
        if ($rs->num_rows > 0) {
            $u = $rs->fetch_assoc();

            if (isset($u["profile_pic"]) && !empty($u["profile_pic"])) {
                unlink(($u["profile_pic"]));
            }

            $imgPath = "resources/profile_image/" . uniqid() . "_" . $_FILES["img"]["name"];
            move_uploaded_file($_FILES["img"]["tmp_name"], $imgPath);

            Database::iud("UPDATE `user` SET `profile_pic`='$imgPath' WHERE `id`='$uid'");
            echo ("success");
        } else {
            echo ("user not found!");
        }
    }else{
        echo("Please Select an Image to Upload");
    }
} else {
    echo ("Please login first!");
    exit();
}
