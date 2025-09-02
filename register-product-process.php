<?php

include "connection.php";

$name = $_POST["name"];
$desc = $_POST["desc"];
$category = $_POST["category"];
$brand = $_POST["brand"];

if (empty($name)) {
    echo ("Please enter the product name");
} else if (empty($desc)) {
    echo ("Please enter the product description");
} else if ($category == 0) {
    echo ("Please Select a Category");
} else if ($brand == 0) {
    echo ("Please Select a Category");
} else {
    $rs = Database::search("SELECT * FROM `product` WHERE `name`='$name'
    AND `brand_id`='$brand' AND `cat_id`='$category' AND `description`='$desc'");
    $num = $rs->num_rows;

    if ($num > 0) {
        echo ("The Product you are going to register is already in the list!");
    } else {


        $length = sizeof($_FILES);

        $d = new DateTime();
        $tz = new DateTimeZone("Asia/Colombo");
        $d->setTimezone($tz);
        $date = $d->format("Y-m-d H:i:s");

        Database::iud("INSERT INTO `product`(`name`,`description`,`brand_id`,`cat_id`,`datetime_added`) 
        VALUES('$name','$desc','$brand','$category','$date') ");

        $product_id = Database::$connection->insert_id;


        if ($length <= 3 && $length > 0) {

            $allowed_image_extensions = array("image/jpeg", "image/png", "image/svg+xml","image/webp");

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
                        } else if ($file_extension == "image/webp") {
                            $new_img_extension = ".webp";
                        }

                        $file_name = "resources//product_images//" . $name . "_" . $x . "_" . uniqid() . $new_img_extension;
                        move_uploaded_file($image_file["tmp_name"], $file_name);

                        Database::iud("INSERT INTO `product_img`(`img_path`,`product_id`) VALUES 
                    ('" . $file_name . "','" . $product_id . "')");
                    } else {
                        echo ("Inavid image type, You can only upload 'jpeg','png' and 'svg' type Images.");
                    }
                }
            }

            echo ("success");
        } else {
            echo ("Invalid Image Count!");
        }
    }
}
