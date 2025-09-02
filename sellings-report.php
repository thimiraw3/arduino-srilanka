<?php
include "connection.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selling Report All Time - Arduino Sri Lanka</title>
    <link rel="icon" href="resources/logo/logo.png" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="bootstrap.bundle.min.js"></script>
</head>

<body onload="loadSalesChart();">

    <div class="container">
        <div class="row mb-5">
            <div class="col-12 mt-5 d-flex justify-content-center gap-3">
                <button class="btn btn-dark" onclick="history.back();"><i class="bi bi-arrow-left"></i> BACK</button>
                <button class="btn btn-danger" onclick="printReport2();"><i class="bi bi-printer-fill"></i> PRINT</button>
            </div>
        </div>
    </div>

    <div class="container" id="printArea">

        <div class="row">
            <div class="col-12 text-center mb-3">
                <h1>Sellings Report</h1>
            </div>

            <div class="row align-content-center justify-content-center">
                <div class="col-8 ">
                    <h2 class="mt-3">Sales Overview</h2>
                    <div class="card mt-3 ms-3">
                        <canvas id="chart1" class="mx-5 my-5"></canvas>
                    </div>
                </div>
            </div>

            <div class="col-12 mt-4 mb-5">
                <h2 class="my-3">Customer Orders</h2>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Invoice Id</th>
                            <th>Product</th>
                            <th>Qty</th>
                            <th>Date Time</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        <?php

                        $rs = Database::search("SELECT `invoice`.`invoice_id`,`stock_view`.`name`,`invoice_items`.`qty`,`invoice`.`date_time`,
                                                (`invoice_items`.`price` * `invoice_items`.`qty`) AS `total`,`order_status`.`status_name`
                                                FROM `invoice_items` INNER JOIN `stock_view` ON `invoice_items`.`stock_id` = `stock_view`.`stock_id`
                                                INNER JOIN `invoice` ON `invoice_items`.`invoice_id`=`invoice`.`id`
                                                INNER JOIN order_status ON invoice.order_status=order_status.status_id
                                                 ORDER BY `invoice`.`date_time` DESC");
                        $num = $rs->num_rows;

                        for ($x = 0; $x < $num; $x++) {
                            $row = $rs->fetch_assoc();
                        ?>

                            <tr>
                                <td><?php echo ($row["invoice_id"]); ?></td>
                                <td><?php echo ($row["name"]); ?></td>
                                <td><?php echo ($row["date_time"]); ?></td>
                                <td><?php echo ($row["qty"]); ?></td>
                                <td><?php echo ($row["total"]); ?></td>
                                <td><?php echo ($row["status_name"]); ?></td>

                            </tr>

                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="script.js"></script>
    <script src="bootstrap.min.js"></script>
    <script src="bootstrap.bundle.js"></script>
</body>

</html>