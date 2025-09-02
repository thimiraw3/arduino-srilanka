<?php

include "connection.php";
session_start();

if (isset($_SESSION["arduino_admin"])) {

    $status = $_GET["status"];

    $purchasedRs = Database::search("SELECT * FROM `invoice` WHERE `order_status`='$status' ORDER BY `date_time` DESC");
    $num = $purchasedRs->num_rows;
}

if ($num > 0) {


    for ($i = 0; $i < $num; $i++) {
        $row = $purchasedRs->fetch_assoc();

        $invoiceId = $row["id"];

        $itemsRs = Database::search("SELECT * FROM `invoice_items` WHERE `invoice_id`='$invoiceId'");
        $itemNum = $itemsRs->num_rows;

?>

        <div class="col-12 card shadow rounded-3 mt-3">
            <div class="row ms-2 mt-2">
                <h3>Order Id : <?php echo $row["invoice_id"]; ?></h3>
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


                $userDataRs = Database::search("SELECT * FROM `user` INNER JOIN `user_address` ON `user_address`.`user_id`=`user`.`id`
                INNER JOIN `destrict` ON `user_address`.`destrict_destrict_id`=`destrict`.`destrict_id`
                INNER JOIN `province` ON `destrict`.`province_province_id`=`province`.`province_id` WHERE `id`='" . $row["user_id"] . "' LIMIT 1 ");
                $userData = $userDataRs->fetch_assoc();

            ?>

                <!-- Perchased item -->


                <div class="row  d-flex justify-content-between align-items-center p-3 mt-3">
                    <div class=" col-12 col-lg-3 d-inline">
                        <img class="rounded-4" src="<?php echo ($image_data2["img_path"]); ?>" alt="" height="150">
                    </div>
                    <div class="col-6 col-lg-3 d-inline mb-2">
                        <h4 class="fw-bold text-color"><?php echo $stock['name']; ?></h4>
                        <p>Category: <?php echo $stock['cat_name']; ?></p>
                        <p>Brand: <?php echo $stock['brand_name']; ?></p>
                        <input type="text" class="form-control text-center rounded-pill" style="width: 100px;" value="<?php echo $stock['p_qty']; ?>" disabled>
                    </div>

                    <div class="d-inline col-6 col-lg-3 text-end">
                        <h5 class=""> Delivery Fee - Rs. <?php echo $userData["delivery_fee"] ?> .00</h5>
                        <h4 class="">Rs. <?php echo $stock['p_price']; ?> .00</h4>
                    </div>

                    <div class="d-inline col-12 col-lg-3">
                        <button type="button" class="btn btn-warning col-12 col-lg-10 mb-2" data-bs-toggle="modal" data-bs-target="#staticBackdrop<?php echo $stock['product_id']; ?>">Update Order Status</button>
                    </div>
                </div>

                <!-- Reveiw Modal -->


                <div class="modal fade" id="staticBackdrop<?php echo $stock['product_id']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Update Order Status</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">

                                <div class="row">
                                    <div class="col-3">
                                        <label class="form-label fw-bold">Order Id</label>
                                    </div>
                                    <div class="col-9">
                                        <label class="form-label"><?php echo $row['invoice_id']; ?></label>
                                    </div>
                                    <div class="col-3">
                                        <label class="form-label fw-bold">Product Name</label>
                                    </div>
                                    <div class="col-9">
                                        <label class="form-label"><?php echo $stock['name']; ?></label>
                                    </div>
                                    <div class="col-3">
                                        <label class="form-label fw-bold">User Name</label>
                                    </div>
                                    <div class="col-9">
                                        <label class="form-label"><?php echo $userData['fname'] . " " . $userData["lname"]; ?></label>
                                    </div>
                                    <div class="col-3">
                                        <label class="form-label fw-bold">User Email</label>
                                    </div>
                                    <div class="col-9">
                                        <label class="form-label"><?php echo $userData['email']; ?></label>
                                    </div>
                                    <div class="col-3">
                                        <label class="form-label fw-bold">Mobile Number</label>
                                    </div>
                                    <div class="col-9">
                                        <label class="form-label"><?php echo $userData['mobile']; ?></label>
                                    </div>
                                    <div class="col-3">
                                        <label class="form-label fw-bold">Address</label>
                                    </div>
                                    <div class="col-9">
                                        <label class="form-label"><?php echo $userData['no'] . "," . $userData["line1"]; ?>,</label>
                                        <label class="form-label"><?php echo $userData['line2'] . "-" . $userData["city"]; ?></label>
                                        <label class="form-label">Destrict : <?php echo $userData['destict_name']; ?></label>
                                        <label class="form-label">/ Province : <?php echo $userData['province_name']; ?></label>
                                        <label class="form-label">Postal Code : <?php echo $userData['postal_code']; ?></label>
                                    </div>
                                    <div class="col-3">
                                        <label class="form-label fw-bold">Order Status</label>
                                    </div>
                                    <div class="col-9">
                                        <select class="form-select" id="orderStatus">
                                            <option value="0">Select Status</option>

                                            <?php
                                            $rs = Database::search("SELECT * FROM `order_status`");
                                            $num2 = $rs->num_rows;

                                            for ($x2 = 0; $x2 < $num2; $x2++) {
                                                $d = $rs->fetch_assoc();
                                            ?>
                                                <option value="<?php echo ($d["status_id"]); ?>
                                    " <?php
                                                if ($row["order_status"] == $d["status_id"]) {
                                        ?> selected <?php
                                                }

                                                    ?>>
                                                    <?php

                                                    echo ($d["status_name"]);
                                                    ?>
                                                </option>
                                            <?php
                                            }

                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-success" onclick="updateOrderStatus('<?php echo $row['id'] ?>');">Update Status</button>
                            </div>
                        </div>
                    </div>
                </div>


            <?php
            }

            ?>

        </div>

    <?php
    }
} else {
    ?>

    <!-- No Purchases -->

    <div class="col-12 text-center mt-5 mb-5">
        <i class="bi bi-emoji-frown-fill text-warning" style="font-size: 150px;"></i>
        <h2 class="text-warning fw-bold">No Items!</h2>
        <span class="text-muted">No items in this order status.</span>
    </div>

    <!-- No Purchases -->

<?php
}
?>