<?php

include "connection.php";
session_start();

if (isset($_SESSION["arduino_user"])) {

    $userId = $_SESSION["arduino_user"]["id"];

    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $mobile = $_POST["mobile"];
    $no = $_POST["no"];
    $line1 = $_POST["line1"];
    $line2 = $_POST["line2"];
    $city = $_POST["city"];
    $destrict = $_POST["destrict"];
    $pcode = $_POST["pcode"];

    if (empty($fname)) {
        echo ("Please enter the First name");
    } else if (empty($lname)) {
        echo ("Please enter the Last Name");
    } else if (empty($mobile)) {
        echo ("Please enter the mobile number");
    } else if (empty($no)) {
        echo ("Please enter the address No.");
    } else if (empty($line1)) {
        echo ("Please enter the address line 1");
    } else if (empty($city)) {
        echo ("Please enter your city name");
    } else if ($destrict == 0) {
        echo ("Please Select the destrict");
    } else {

        $rs = Database::search("SELECT * FROM `user` WHERE `id`='$userId'");
        $num = $rs->num_rows;

        if ($num > 0) {

            Database::iud("UPDATE `user` SET `fname`='$fname',`lname`='$lname',`mobile`='$mobile' WHERE `id`='$userId'");

            $addressRs = Database::search("SELECT * FROM `user_address` WHERE `user_id`='$userId'");
            $addressNum = $addressRs->num_rows;

            if ($addressNum > 0) {

                Database::iud("UPDATE `user_address` SET `no`='$no',`line1`='$line1',`line2`='$line2',`city`='$city',
                `destrict_destrict_id`='$destrict',`postal_code`='$pcode' WHERE `user_id`='$userId'");
            } else {

                Database::iud("INSERT INTO `user_address`(`no`,`line1`,`line2`,`postal_code`,`city`,`user_id`,`destrict_destrict_id`) 
                VALUES('$no','$line1','$line2','$pcode','$city','$userId','$destrict')");
            }


            echo ("success");
        } else {
            echo ("User Not Found");
        }
    }
} else {
    echo ("An error occured please try again later");
}
