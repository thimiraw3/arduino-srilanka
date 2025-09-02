<?php

include "connection.php";
session_start();

if (isset($_SESSION["arduino_user"])) {

    $userId = $_SESSION["arduino_user"]["id"];

    $wRs = Database::search("SELECT * FROM `wishlist` WHERE `user_id` = '$userId'");
    $num = $wRs->num_rows;
}


if ($num > 0) {

?>

    <div class="col-12">
        <div class="row d-flex justify-content-start">

            <?php

            for ($i = 0; $i < $num; $i++) {
                $row = $wRs->fetch_assoc();

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
                        </div>

                        <div class="col-12 text-end mt-3">
                            <h5 class="fw-bold text-primary">Rs.<?php echo $stock['price']; ?>.00</h5>
                            <button onclick="removeFromWishlist(<?php echo $row['id']; ?>);" class="btn btn-danger col-12"><i class="bi bi-trash3"></i></button>

                        </div>
                    </div>
                </div>

                <!-- cart item -->

            <?php

            }

            ?>

        </div>
    </div>

<?php
} else {
?>

    <div class="col-12 text-center my-5">
        <i class="bi bi-exclamation-triangle-fill text-danger" style="font-size: 150px;"></i>
        <h2 class="text-danger fw-bold">No Products In Your Wishlist!</h2>
        <span class="text-muted">Add products to your wishlist to view in here.</span>
    </div>

<?php
}
?>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="script.js"></script>
<script src="bootstrap.min.js"></script>