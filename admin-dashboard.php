<?php

include "connection.php";
session_start();

if (isset($_SESSION["arduino_admin"])) {

    $userId = $_SESSION["arduino_admin"]["id"];
    $rs = Database::search(("SELECT * FROM `user` WHERE `id`='$userId'"));

    if ($rs->num_rows < 1) {
        header("Location:admin-signin.php");
    }

    $userDetails = $rs->fetch_assoc();

?>


    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin dashboard | Arduino Sri-Lanka</title>
        <link rel="icon" href="resources/logo/logo.png" />
        <link rel="stylesheet" href="style.css" />
        <link rel="stylesheet" href="bootstrap.css" />
        <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <script src="bootstrap.bundle.min.js"></script>
    </head>

    <body class="overflow-x-hidden admin-body2" onload="loadCharts();">

        <?php include "admin-header.php" ?>

        <div class="row">

            <div class="col-1">
                <?php include "dashboard-sidebar.php" ?>
            </div>

            <div class="container col-8">
                <div class="row">

                    <div class="col-12">
                        <h2 class="mt-3">Sales Overview</h2>
                        <div class="card mt-3 ms-3">
                            <canvas id="chart1" class="mx-5 my-5"></canvas>
                        </div>
                    </div>

                    <div class="col-12">

                        <h2 class="mt-3">Most Popular Products</h2>
                        <div class="card mt-3">
                            <canvas id="chart3" class="mx-5 my-5"></canvas>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-6">

                        <h2 class="mt-3">Sales Revenue By Category</h2>
                        <div class="card mt-3">
                            <canvas id="chart2" class="mx-5 my-5"></canvas>
                        </div>
                    </div>
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