<?php
include "connection.php";

$wishlistId = $_GET["id"];

if(empty($wishlistId)){
    echo "Invalid request";
}else{

    $rs = Database::search("SELECT * FROM `wishlist` WHERE `id`='$wishlistId'");
    $num = $rs->num_rows;

    if($num > 0){
        Database::iud("DELETE FROM `wishlist` WHERE `id`='$wishlistId'");
        echo "success";
    }else{
        echo "Wishlist item not found!";
    }
}