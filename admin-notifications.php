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
        <title>Admin Notifications | Arduino Sri-Lanka</title>
        <link rel="icon" href="resources/logo/logo.png" />
        <link rel="stylesheet" href="style.css" />
        <link rel="stylesheet" href="bootstrap.css" />
        <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <script src="bootstrap.bundle.min.js"></script>
    </head>

    <body class="overflow-x-hidden admin-body2">

        <?php include "admin-header.php" ?>

        <div class="row">

            <div class="col-1">
                <?php include "dashboard-sidebar.php" ?>
            </div>

            <?php

            $lowStockRs = Database::search("SELECT * FROM `stock_view` WHERE `qty`<'10' AND `status`='1'");
            $num = $lowStockRs->num_rows;

            ?>

            <div class="container col-8 mt-5">
                <div class="row">
                    <?php

                    if ($num > 0) {

                        for ($x = 0; $x < $num; $x++) {

                            $msg_data = $lowStockRs->fetch_assoc();

                    ?>

                            <h2 class="mb-3">Notifications</h2>

                            <div class="card shadow rounded-3">
                                <h2 class="text-danger mt-2 ms-2">Low Stock Alert</h2>
                                <div class="ms-4 my-2">
                                    <span>Stock Id : <?php echo $msg_data["stock_id"]; ?></span><br>
                                    <span>Product Name : <?php echo $msg_data["name"]; ?></span><br>
                                    <span>Brand Name : <?php echo $msg_data["brand_name"]; ?></span><br>
                                    <span>Category : <?php echo $msg_data["cat_name"]; ?></span><br>
                                    <span>Available Qty : <?php echo $msg_data["qty"]; ?></span><br>
                                </div>
                            </div>

                        <?php
                        }
                    } else {


                        ?>

                        <div class="col-12 text-center mt-5 mb-5">
                            <h2 class="text-warning fw-bold">No Notifications!</h2>
                        </div>

                    <?php

                    }

                    ?>



                </div>
            </div>

            <?php
            include "admin-footer.php";
            ?>


            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script src="script.js"></script>
            <script src="bootstrap.min.js"></script>
            <script src="bootstrap.bundle.js"></script>

    </body>

    </html>


<?php

} else {
    header("Location:admin-signin.php");
}

?>