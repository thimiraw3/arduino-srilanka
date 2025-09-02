<?php

include "connection.php";

$id = $_POST["id"];
$name = $_POST["name"];
$desc = $_POST["desc"];
$category = $_POST["cat"];
$brand = $_POST["brand"];

if (empty($name)) {
    echo ("Please enter the product name");
} else if (empty($desc)) {
    echo ("Please enter the product description");
} else if ($category == 0) {
    echo ("Please Select a Category");
} else if ($brand == 0) {
    echo ("Please Select a Brand");
} else {

    $rs = Database::search("SELECT * FROM `product` WHERE `id` !='$id' AND (`name`='$name' AND 
    `brand_id`='$brand' AND `cat_id`='$category' AND `description`='$desc')");

    $num = $rs->num_rows;

    if ($num > 0) {
        echo ("The product you are going to update is already in the list");
    } else {

        Database::iud("UPDATE `product` SET `name`='$name',`description`='$desc',
        `brand_id`='$brand',`cat_id`='$category' WHERE `id`='$id'");

        $length = sizeof($_FILES);

        if ($length == 0) {
            echo ("success");
        } else {

            if ($length <= 3) {

                $allowed_image_extensions = array("image/jpeg", "image/png", "image/svg+xml");

                $img_rs = Database::search("SELECT * FROM `product_img` WHERE `product_id`='" . $id . "'");
                $img_num = $img_rs->num_rows;

                for ($y = 0; $y < $img_num; $y++) {
                    $img_data = $img_rs->fetch_assoc();

                    unlink($img_data["img_path"]);
                    Database::iud("DELETE FROM `product_img` WHERE `product_id`='" . $id . "'");
                }

                for ($x = 0; $x < $length; $x++) {
                    if (isset($_FILES["image" . $x])) {

                        $image_file = $_FILES["image" . $x];
                        $file_extension = $image_file["type"];

                        if (in_array($file_extension, $allowed_image_extensions)) {

                            $new_img_extension;

                            if ($file_extension == "image/jpeg") {
                                $new_img_extension = ".jpeg";
                            } else if ($file_extension == "image/png") {
                                $new_img_extension = ".png";
                            } else if ($file_extension == "image/svg+xml") {
                                $new_img_extension = ".svg";
                            }

                            $file_name = "resources//product_images//" . $name . "_" . $x . "_" . uniqid() . $new_img_extension;
                            move_uploaded_file($image_file["tmp_name"], $file_name);

                            Database::iud("INSERT INTO `product_img`(`img_path`,`product_id`) VALUES 
                        ('" . $file_name . "','" . $id . "')");

                            // echo ("success");
                        } else {
                            echo ("Inavid image type.");
                        }
                    }
                }

                echo ("success");
            } else {
                echo ("Invalid Image Count! You can only upload 3 images Max");
            }
        }
    }
}
