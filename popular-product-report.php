<?php
include "connection.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Report - Arduino Sri Lanka</title>
    <link rel="icon" href="resources/logo/logo.png" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="bootstrap.bundle.min.js"></script>
</head>

<body onload="loadMostPopularProducts();">

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
                <h1>Popular Products Report</h1>
            </div>

            <div class="row align-content-center justify-content-center">
                <div class="col-8 ">
                    <h2 class="mt-3">Most Popular Products</h2>
                    <div class="card mt-3 ms-3">
                        <canvas id="chart3" class="mx-5 my-5"></canvas>
                    </div>
                </div>
            </div>

            <div class="col-12 mt-4 mb-5">
                <h2 class="my-3">Customer Orders</h2>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Product Name</th>
                            <th>Sold Quantity</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        <?php


                        $rs = Database::search("SELECT `stock_view`.`name` AS `product_name`,SUM(`invoice_items`.`qty`) AS `total_quantity`
                        FROM `invoice_items`JOIN `stock_view` ON `invoice_items`.`stock_id` = `stock_view`.`stock_id` GROUP BY `stock_view`.`name`
                        ORDER BY `total_quantity` DESC LIMIT 10 ");

                        $num = $rs->num_rows;

                        for ($x = 0; $x < $num; $x++) {
                            $row = $rs->fetch_assoc();
                        ?>

                            <tr>
                                <td><?php echo ($row["product_name"]); ?></td>
                                <td><?php echo ($row["total_quantity"]); ?></td>

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