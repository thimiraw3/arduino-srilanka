<?php

include "connection.php";
session_start();

if (isset($_SESSION["arduino_user"])) {

    $sort = "1";

    if (isset($_GET["sort"])) {

        $userId = $_SESSION["arduino_user"]["id"];
        $sort = $_GET["sort"];

        $query = "SELECT * FROM `invoice` INNER JOIN `order_status` ON `invoice`.`order_status`=`order_status`.`status_id` WHERE `user_id`='$userId'";

        if ($sort == 1) {

            $query .= "";
        }
        if ($sort == 2) {

            $query .= " AND `order_status`='2'";
        }
        if ($sort == 3) {

            $query .= " AND `order_status`='3'";
        }
        if ($sort == 4) {

            $query .= " AND `order_status`='4'";
        }

        $query .= " ORDER BY `date_time` DESC";


        $purchasedRs = Database::search($query);
        $num = $purchasedRs->num_rows;

        if ($num > 0) {


            for ($i = 0; $i < $num; $i++) {
                $row = $purchasedRs->fetch_assoc();

                $invoiceId = $row["id"];

                $itemsRs = Database::search("SELECT * FROM `invoice_items` WHERE `invoice_id`='$invoiceId'");
                $itemNum = $itemsRs->num_rows;

?>

                <div class="col-12 card shadow rounded-3 mt-3">
                    <div class="row mx-2 mt-2">
                        <div class="col-6">
                            <h3 class="col-12 col-md-6 col-lg-6">Order Id : <?php echo $row["invoice_id"]; ?></h3>
                            <h6>Order Placed On : <?php echo $row["date_time"]; ?></h6>
                        </div>
                        <div class="col-6 text-end">
                            <h3 class="text-success">Order Status : <?php echo $row["status_name"]; ?></h3>
                            <a class="btn btn-secondary" href="invoice.php?orderId=<?php echo $row["invoice_id"]; ?>">See Invoice</a>
                        </div>
                    </div>
                    <hr>

                    <?php


                    for ($x = 0; $x < $itemNum; $x++) {

                        $item = $itemsRs->fetch_assoc();

                        $stockId = $item["stock_id"];

                        $stockRs = Database::search("SELECT `invoice_items`.`qty` AS `p_qty`,`stock_view`.`name`,`stock_view`.`product_id`,`stock_view`.`cat_name`
                ,`stock_view`.`brand_name`,`invoice_items`.`price` AS `p_price` FROM `invoice_items` INNER JOIN stock_view ON invoice_items.stock_id = 
                stock_view.stock_id WHERE `stock_view`.`stock_id` = '$stockId'");

                        $stock = $stockRs->fetch_assoc();

                        $productId = $stock["product_id"];

                        $image_rs2 = Database::search("SELECT `img_path` FROM `product_img` WHERE `product_id`='" . $productId . "' LIMIT 1 ");
                        $image_data2 = $image_rs2->fetch_assoc();

                    ?>

                        <!-- Perchased item -->


                        <div class="row  d-flex justify-content-between align-items-center p-3 mt-3">
                            <div class=" col-12 col-lg-3 d-inline">
                                <a class="link-dark text-decoration-none" href="single-product-view.php?product=<?php echo $stockId; ?>">
                                    <img class="rounded-4" src="<?php echo ($image_data2["img_path"]); ?>" alt="" height="200">
                                </a>
                            </div>
                            <div class="col-6 col-lg-3 d-inline mb-2">
                                <h4 class="fw-bold text-color"><?php echo $stock['name']; ?></h4>
                                <p>Category: <?php echo $stock['cat_name']; ?></p>
                                <p>Brand: <?php echo $stock['brand_name']; ?></p>
                                <input type="text" class="form-control text-center rounded-pill" style="width: 100px;" value="<?php echo $stock['p_qty']; ?>" disabled>
                            </div>

                            <div class="d-inline col-6 col-lg-3 text-end">
                                <h4 class="">Unit Price : Rs. <?php echo $stock['p_price']; ?> .00</h4>
                            </div>

                            <div class="d-inline col-12 col-lg-3">
                                <button type="button" class="btn btn-warning col-12 col-lg-10 mb-2" data-bs-toggle="modal" data-bs-target="#staticBackdrop<?php echo $stock['product_id']; ?>" <?php if ($row["order_status"] != 4) { ?> disabled <?php
                                                                                                                                                                                                                                                }; ?>>Write A Review</button>
                            </div>
                        </div>


                        <?php

                        $feed_rs = Database::search("SELECT * FROM `feedback` WHERE `product_id` = '" . $stock["product_id"] . "' AND `user_id` = '" . $userId . "'");
                        $feed_num = $feed_rs->num_rows;

                        if ($feed_num == 1) {

                            $feed_data = $feed_rs->fetch_assoc();

                        ?>

                            <!-- Reveiw Modal -->

                            <div class="modal fade" id="staticBackdrop<?php echo $stock['product_id']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Update Review : <?php echo $stock['name']; ?></h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">

                                            <div class="row">
                                                <div class="col-3">
                                                    <label class="form-label fw-bold">Rate Our Product</label>
                                                </div>
                                                <div class="col-8">
                                                    <div class="star-rating">
                                                        <input type="radio" id="star5" name="urating" value="5"><label for="star5">★</label>
                                                        <input type="radio" id="star4" name="urating" value="4"><label for="star4">★</label>
                                                        <input type="radio" id="star3" name="urating" value="3"><label for="star3">★</label>
                                                        <input type="radio" id="star2" name="urating" value="2"><label for="star2">★</label>
                                                        <input type="radio" id="star1" name="urating" value="1"><label for="star1">★</label>
                                                    </div>
                                                    <p>You rated our product <span id="result"><?php echo $feed_data["rating"]; ?></span> stars previously.</p>
                                                </div>
                                                <div class="col-3">
                                                    <label class="form-label fw-bold">User's Email</label>
                                                </div>
                                                <div class="col-9">
                                                    <input type="text" class="form-control" disabled id="mail" value="<?php echo ($_SESSION["arduino_user"]["email"]); ?>" />
                                                </div>
                                                <div class="col-12 mt-2">
                                                    <div class="row">
                                                        <div class="col-3">
                                                            <label class="form-label fw-bold">Feedback</label>
                                                        </div>
                                                        <div class="col-9">
                                                            <textarea class="form-control" cols="50" rows="8" id="ufeed" placeholder="<?php echo $feed_data["feedback"]; ?>"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-success" onclick="updateFeedback(<?php echo $stock['product_id'] ?>);">Update Feedback</button>
                                        </div>
                                    </div>
                                </div>
                            </div>



                            <!-- Reveiw Modal -->

                        <?php

                        } else {

                        ?>


                            <div class="modal fade" id="staticBackdrop<?php echo $stock['product_id']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Write a Review : <?php echo $stock['name']; ?></h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">

                                            <div class="row">
                                                <div class="col-3">
                                                    <label class="form-label fw-bold">Rate Our Product</label>
                                                </div>
                                                <div class="col-8">
                                                    <div class="star-rating">
                                                        <input type="radio" id="star5" name="rating" value="5"><label for="star5">★</label>
                                                        <input type="radio" id="star4" name="rating" value="4"><label for="star4">★</label>
                                                        <input type="radio" id="star3" name="rating" value="3"><label for="star3">★</label>
                                                        <input type="radio" id="star2" name="rating" value="2"><label for="star2">★</label>
                                                        <input type="radio" id="star1" name="rating" value="1"><label for="star1">★</label>
                                                    </div>
                                                </div>
                                                <div class="col-3">
                                                    <label class="form-label fw-bold">User's Email</label>
                                                </div>
                                                <div class="col-9">
                                                    <input type="text" class="form-control" disabled id="mail" value="<?php echo ($_SESSION["arduino_user"]["email"]); ?>" />
                                                </div>
                                                <div class="col-12 mt-2">
                                                    <div class="row">
                                                        <div class="col-3">
                                                            <label class="form-label fw-bold">Feedback</label>
                                                        </div>
                                                        <div class="col-9">
                                                            <textarea class="form-control" cols="50" rows="8" id="feed"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-success" onclick="saveFeedback(<?php echo $stock['product_id'] ?>);">Save Feedback</button>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        <?php
                        }

                        ?>

                        <!-- Perchased item -->

                    <?php
                    }
                    ?>


                    <hr>
                    <div class="row text-end me-2">
                        <h5> Delivery Fee - Rs. <?php echo $row["delivery_fee"] ?> .00</h5>
                        <h3>Total : <?php echo $row["total"]; ?></h3>
                    </div>


                </div>

            <?php
            }
        } else {
            ?>

            <!-- No Purchases -->

            <div class="col-12 text-center mt-5 mb-5">
                <i class="bi bi-emoji-frown-fill text-warning" style="font-size: 150px;"></i>
                <h2 class="text-warning fw-bold">No Items!</h2>
            </div>

            <!-- No Purchases -->



<?php
        }
    }
} else {
    header("Location:sign-in.php");
}
?>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="script.js"></script>
<script src="bootstrap.min.js"></script>