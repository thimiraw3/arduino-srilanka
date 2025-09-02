<?php

include "connection.php";
session_start();

if (isset($_SESSION["arduino_user"])) {

    $userId = $_SESSION["arduino_user"]["id"];

    $sRs = Database::search("SELECT * FROM `cart` WHERE `user_id` = '$userId'");
    $num = $sRs->num_rows;
}


if ($num > 0) {

?>

    <div class="col-12">
        <div class="row d-flex justify-content-start">

            <?php

            $netTotal = 0;

            for ($i = 0; $i < $num; $i++) {
                $row = $sRs->fetch_assoc();

                $stockId = $row["stock_id"];

                $stockRs = Database::search("SELECT * FROM `stock_view` WHERE `stock_id` = '$stockId'");
                $stock = $stockRs->fetch_assoc();

                $productId = $stock["product_id"];

                $image_rs2 = Database::search("SELECT `img_path` FROM `product_img` WHERE `product_id`='" . $productId . "'");
                $image_data2 = $image_rs2->fetch_assoc();

            ?>

                <!-- cart item -->

                <div class="col-10 col-md-6 col-lg-3 ms-3">
                    <div class="row border border-3 rounded-4 p-3 mb-2 d-flex align-items-center">
                        <a class="text-decoration-none" href="single-product-view.php?product=<?php echo ($row["stock_id"]); ?>">
                            <div class="col-12 d-flex justify-content-center">
                                <img src="<?php echo ($image_data2["img_path"]); ?>" class="rounded-4" style="height: 200px;" alt="product_image">
                            </div>
                        </a>
                        <div class="mt-4 card-body col-12">
                            <h4 class="fw-bold text-color"><?php echo $stock['name']; ?></h4>
                            <p class="text-secondary text-truncate"><?php echo ($stock["description"]); ?></p>
                            <p class="fw-bold">Product Category: <?php echo $stock['cat_name']; ?></p>
                            <p class="fw-bold">Product Brand: <?php echo $stock['brand_name']; ?></p>
                            <div class="gap-2 d-flex justify-content-end">
                                <button class="btn btn-light rounded-2" onclick="decrementCartQty(<?php echo $row['id']; ?>);">&minus;</button>
                                <input id="qty-<?php echo $row['id']; ?>" type="text" class="form-control text-center rounded-2" style="width: 100px;" value="<?php echo $row['qty']; ?>" disabled>
                                <button class="btn btn-light rounded-2" onclick="incrementCartQty(<?php echo $row['id']; ?>);">&plus;</button>
                            </div>
                        </div>

                        <div class="col-12 text-end mt-3">
                            <?php
                            $pTotal = $stock["price"] * $row["qty"];
                            $netTotal += $pTotal;
                            ?>

                            <h5 class="fw-bold text-primary">Rs.<?php echo $stock['price']; ?>.00</h5>
                            <h5 class="fw-bold text-primary-emphasis">x<?php echo $row['qty']; ?></h5>
                            <h4 class="">Rs. <?php echo $pTotal ?> .00</h4>

                            <button onclick="removeFromCart(<?php echo $row['id']; ?>);" class="btn btn-danger col-12"><i class="bi bi-trash3"></i></button>

                        </div>
                    </div>
                </div>

                <!-- cart item -->

            <?php


            }


            ?>

        </div>
    </div>

    <div class="col-12">
        <hr>
    </div>

    <div class="col-12 text-end">
        <h5>Number of Items: <span class="text-warning fw-bold"><?php echo $num; ?></span></h5>
        <?php

        $deliveryFeeRs = Database::search("SELECT * FROM `user_address` INNER JOIN `destrict` ON `user_address`.`destrict_destrict_id`= `destrict`.`destrict_id`
        INNER JOIN `province` ON `destrict`.`province_province_id`=`province`.`province_id` WHERE `user_id`='$userId'");

        $delivery_num = $deliveryFeeRs->num_rows;

        $delivery = 0;

        if ($delivery_num > 0) {
            $deliveryRow = $deliveryFeeRs->fetch_assoc();
            $delivery = $deliveryRow["delivery_fee"];
        }

        $netTotal += $delivery;
        ?>
        <h4>Delivery Fee: <span class="text-muted">Rs.<?php echo $delivery; ?>.00</span></h4>
        <h2>Net Total: <span class="text-success-emphasis">Rs.<?php echo $netTotal; ?>.00</span></h2>
        <button class="btn btn-success w-25 rounded-2 mb-2" onclick="checkout();">Check Out</button>
        <h6>* All the products will be delivered to your address in the billing details, Enter your address correctly.</h6>
    </div>

<?php
} else {
?>

    <div class="col-12 text-center my-5">
        <i class="bi bi-exclamation-triangle-fill text-danger" style="font-size: 150px;"></i>
        <h2 class="text-danger fw-bold">No Products In Your Cart!</h2>
        <span class="text-muted">Add products to your cart to view in here.</span>
    </div>

<?php
}
?>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="script.js"></script>
<script src="bootstrap.min.js"></script>