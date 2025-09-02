<?php

include "connection.php";
session_start();

if (!isset($_SESSION["arduino_user"]) || !isset($_GET["orderId"])) {
    header("Location: sign-In.php");
}

$user = $_SESSION["arduino_user"];

$invoiceId = $_GET["orderId"];

$invoiceRs = Database::search("SELECT * FROM `invoice` WHERE `invoice_id`='$invoiceId'");
$num = $invoiceRs->num_rows;

if ($num < 1) {
    header("Location: order-history.php");
}

$invoice = $invoiceRs->fetch_assoc();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice | #<?php echo $invoiceId; ?></title>
    <link rel="icon" href="resources/logo/logo.png" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>

    <div class="container">
        <div class="row d-flex justify-content-center">

            <div class="col-10 text-end my-3">
                <button onclick="printReport();" class="btn btn-danger btn-sm col-2">Save Or Print</button>
            </div>

            <div class="col-10 card  shadow" id="printArea">
                <div class="card-body">

                    <div class="row">
                        <div class="col-6">

                            <h1 class="fw-bold text-color mb-4">
                                <img src="resources/logo/logo.png" class="me-3 bg-light rounded-2" height="50" />Arduino Sri-lanka
                            </h1>

                        </div>

                        <div class="col-6 text-end">

                            <h3 class="fs-3 fw-bold">INVOICE #<?php echo $invoice["invoice_id"]; ?></h3>

                            <p><span class="fw-bold">DATE : </span><?php echo $invoice["date_time"]; ?></p>

                        </div>

                        <div class="col-6">
                            <div class="fw-bolder fs-5 mt-3">From : </div>
                            <div class=" fs-5 mt-1">Arduino Sri-Lanka (Pvt) Ltd.</div>
                            <div>No. 25</div>
                            <div>Colombo road,</div>
                            <div>Kandy.</div>
                            <div>Mobile : 07XXXXXXXX</div>
                        </div>

                        <div class="col-6 text-end">
                            <div class="fw-bolder fs-5 mt-3">Billed To : </div>
                            <div class="fs-5 mt-1"><?php echo $_SESSION["arduino_user"]["fname"] . " " . $_SESSION["arduino_user"]["lname"] ?></div>

                            <?php
                            $addressRs = Database::search("SELECT * FROM `order_address` WHERE `invoice_id`='" .  $invoice["id"] . "'");
                            if ($addressRs->num_rows > 0) {
                                $address = $addressRs->fetch_assoc();
                            ?>
                                <div>No <?php echo $address["no"] ?></div>
                                <div> <?php echo $address["address"] ?></div>
                                <div> <?php echo $address["city"] ?>.</div>
                                <div>Postal Code : <?php echo $address["postal_code"] ?></div>
                            <?php
                            }
                            ?>
                        </div>

                        <div class="col-12 mt-4">
                            <table class="table table-secondary">
                                <thead>
                                    <tr>
                                        <th>Product Name</th>
                                        <th>Price</th>
                                        <th>qty</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $invoiceItemsRs = Database::search("SELECT `invoice_items`.`price`,`invoice_items`.`qty`,`stock_view`.`name`
                                    FROM `invoice_items` JOIN `stock_view` ON `invoice_items`.`stock_id`=`stock_view`.`stock_id`
                                    WHERE `invoice_items`.`invoice_id`='" . $invoice["id"] . "'");

                                    $total = 0;
                                    while ($invoiceItems = $invoiceItemsRs->fetch_assoc()) {
                                        $total += $invoiceItems["price"] * $invoiceItems["qty"];
                                    ?>

                                        <tr>
                                            <td><?php echo $invoiceItems["name"]; ?></td>
                                            <td>Rs.<?php echo $invoiceItems["price"]; ?>.00</td>
                                            <td><?php echo $invoiceItems["qty"]; ?></td>
                                            <td>Rs.<?php echo $invoiceItems["qty"] * $invoiceItems["price"]; ?>.00</td>
                                        </tr>

                                    <?php
                                    }
                                    ?>

                                </tbody>
                            </table>
                        </div>

                        <div class="col-6 mt-3">
                            <h3 class="fw-bold text-color">Thank You For Choosing Us..!</h3>
                        </div>

                        <div class="col-6 mt-3 text-end">
                            <div>
                                <span class="fw-bold fs-5">Sub Total:</span>
                                <span>Rs. <?php echo $total; ?>.00</span>
                            </div>

                            <div>
                                <span class="fw-bold fs-5">Delivery:</span>
                                <span>Rs. <?php echo $invoice["delivery_fee"]; ?>.00</span>
                            </div>

                            <div>
                                <span class="fw-bold fs-5">Net Total:</span>
                                <span>Rs. <?php echo $invoice["total"]; ?>.00</span>
                            </div>
                        </div>

                    </div>

                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="script.js"></script>
    <script src="bootstrap.min.js"></script>
</body>

</html>