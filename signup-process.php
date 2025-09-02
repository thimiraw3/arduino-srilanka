<?php

include "connection.php";

$fname = $_POST["fname"];
$lname = $_POST["lname"];
$mobile = $_POST["mobile"];
$email = $_POST["email"];
$password = $_POST["password"];

$mobilePattern = "/07[0,1,2,4,5,6,7,8]{1}[0-9]{7}/";
$passwordPattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/';

if (empty($fname)) {
    echo ("Please enter your first name");
} else if (strlen($fname) > 20) {
    echo ("Your first name should be less than 20 characters");
} else if (empty($lname)) {
    echo ("Please enter your last name");
} else if (strlen($lname) > 20) {
    echo ("Your last name should be less than 20 characters");
} else if (empty($mobile)) {
    echo ("Please enter your mobile number");
} else if (strlen($mobile) != 10) {
    echo ("Your mobile number must contain 10 characters");
} else if (!preg_match($mobilePattern, $mobile)) {
    echo ("Invalid mobile number");
} else if (empty($email)) {
    echo ("Please enter your email address");
} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo ("Invalid email address");
} else if (empty($password)) {
    echo ("Please enter your password");
} else if (!preg_match($passwordPattern, $password)) {
    echo ("your password should contain minimum 8 characters, at least one uppercase letter, one lowercase letter, and one digit!");
} else {

    $rs = Database::search("SELECT * FROM `user` WHERE `email`='$email' AND `password`='$password'");
    $num = $rs->num_rows;

    if ($num > 0) {
        echo ("User has been already registered with the given email");
    } else {

        Database::iud("INSERT INTO `user`(`fname`,`lname`,`mobile`,`email`,`password`,`user_type_id`) VALUES
        ('$fname','$lname','$mobile','$email','$password','2')");
        echo ("success");
    }
}
