<?php

include "connection.php";
session_start();

if (isset($_SESSION["arduino_admin"])) {
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Stock Management | Arduino Sri-Lanka</title>
        <link rel="icon" href="resources/logo/logo.png" />
        <link rel="stylesheet" href="style.css" />
        <link rel="stylesheet" href="bootstrap.css" />
        <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    </head>

    <body onload="loadStock(1);">

        <?php include "admin-header.php"; ?>

        <div class="container admin-body">
            <div class="row d-flex justify-content-center">

                <div class="col-lg-6 col-md-8 col-10">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" id="stockSearchTxt" placeholder="search by Name,Category or Brand" aria-label="Recipient's username" aria-describedby="button-addon2">
                        <button class="btn btn-outline-dark" type="button" id="button-addon2" onclick="loadStock(0);">Search</button>
                    </div>
                </div>

                <div class="col-10 mt-3">

                    <div class="row">
                        <div class="col-6">
                            <h2 class="">Stock Management</h2>
                        </div>

                        <div class="col-6 text-end">
                            <button class="special-button1" data-bs-toggle="modal" data-bs-target="#addStockModal">Add Stock</button>
                        </div>

                    </div>

                    <div class="mt-4 table-responsive" id="content">

                    </div>
                </div>
            </div>
        </div>



        <?php include "admin-footer.php"; ?>


        <!-- add stock modal -->

        <div class="modal fade" id="addStockModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Stock</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-2">
                            <label class="form-label" for="prodName">Product</label>
                            <select class="form-select" id="product">
                                <option>Select Product</option>

                                <?php
                                $rs = Database::search("SELECT * FROM `product_details` WHERE `status`='1'");
                                $num = $rs->num_rows;

                                for ($x = 0; $x < $num; $x++) {
                                    $row = $rs->fetch_assoc();
                                ?>
                                    <option value="<?php echo ($row["id"]); ?>"><?php echo ($row["name"] . " - " . $row["brand_name"] . " - " . $row["cat_name"]); ?></option>
                                <?php
                                }

                                ?>

                            </select>
                        </div>

                        <div class="mb-2">
                            <label class="form-label" for="">Qty</label>
                            <input id="qty" class="form-control" type="text">
                        </div>

                        <div class="mb-2">
                            <label class="form-label" for="">Unit Price</label>
                            <input id="unitPrice" class="form-control" type="text">
                        </div>

                        <div class="mb-2">
                            <label class="form-label" for="">Warenty</label>
                            <input id="warenty" class="form-control" type="text">
                        </div>

                        <div class="mb-2">
                            <label class="form-label" for="">Discount</label>
                            <input id="discount" class="form-control" type="text">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">CLOSE</button>
                        <button type="button" class="btn btn-primary" onclick="addStock();">ADD STOCK</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- add stock modal -->

        <!-- Update stock modal -->

        <div class="modal fade" id="updateStockModel" tabindex="-1" aria-hidden="false">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Stock</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <div class="mb-2">
                            <label class="form-label" for="">Stock Id</label>
                            <input id="uStockId" class="form-control" type="text" disabled>
                        </div>

                        <div class="mb-2">
                            <label class="form-label" for="prodName">Product</label>
                            <select class="form-select" id="uStockProduct" disabled>
                                <option>Select Product</option>

                                <?php
                                $rs = Database::search("SELECT * FROM `product_details` WHERE `status`='1'");
                                $num = $rs->num_rows;

                                for ($x = 0; $x < $num; $x++) {
                                    $row = $rs->fetch_assoc();
                                ?>
                                    <option value="<?php echo ($row["id"]); ?>"><?php echo ($row["name"] . " - " . $row["brand_name"] . " - " . $row["cat_name"]); ?></option>
                                <?php
                                }

                                ?>

                            </select>
                        </div>

                        <div class="mb-2">
                            <label class="form-label" for="">Qty</label>
                            <input id="uStockQty" class="form-control" type="text" disabled>
                        </div>

                        <div class="mb-2">
                            <label class="form-label" for="">Unit Price</label>
                            <input id="uStockUnitPrice" class="form-control" type="text" disabled>
                        </div>

                        <div class="mb-2">
                            <label class="form-label" for="">Warenty</label>
                            <input id="uWarenty" class="form-control" type="text">
                        </div>

                        <div class="mb-2">
                            <label class="form-label" for="">Discount</label>
                            <input id="uDiscount" class="form-control" type="text">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">CLOSE</button>
                        <button type="button" class="btn btn-primary" onclick="updateStock();">ADD STOCK</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Update stock modal -->

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="script.js"></script>
        `<script src="bootstrap.min.js"></script>

    </body>

    </html>



<?php

} else {
    header("Location: admin-signin.php");
}

?>