<?php

include "connection.php";

$fName = $_POST["fname"];
$lName = $_POST["lname"];
$email = $_POST["email"];
$message = $_POST["message"];

if (empty($fName)) {
    echo ("Please enter your first name");
} else if (strlen($fName) > 20) {
    echo ("Your first name should be less than 20 characters");
} else if (empty($lName)) {
    echo ("Please enter your last name");
} else if (strlen($lName) > 20) {
    echo ("Your last name should be less than 20 characters");
} else if (empty($email)) {
    echo ("Please enter your email address");
} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo ("Invalid email address");
} else if (empty($message)) {
    echo ("Please enter your message");
} else {

    $d = new DateTime();
    $tz = new DateTimeZone("Asia/Colombo");
    $d->setTimezone($tz);
    $date = $d->format("Y-m-d H:i:s");

    Database::iud("INSERT INTO `customer_questions`(`f_name`,`l_name`,`email`,`message`,`datetime`) VALUES ('$fName','$lName','$email','$message','$date')");
    echo ("success");
}
