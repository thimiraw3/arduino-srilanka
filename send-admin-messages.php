<?php

session_start();
include "connection.php";

if(isset($_SESSION["arduino_admin"])){

    $admin_id = $_SESSION["arduino_admin"]["id"];
    $message = $_POST["message"];
    $receiver = $_POST["user"];

    if(!empty($message)){

        $d = new DateTime();
        $tz = new DateTimeZone("Asia/Colombo");
        $d->setTimezone($tz);
        $date = $d->format("Y-m-d H:i:s");
        
        Database::iud("INSERT INTO `message`(`message`,`timestamp`,`sender`,`receiver`,`status`) VALUES('$message','$date','$admin_id','$receiver','0')");
        echo "success";

    }else{
        echo "Please enter a message to send";
    }


}else{
    header("Location:admin-signin.php");
}

