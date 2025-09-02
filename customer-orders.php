<?php

include "connection.php";
session_start();

if (isset($_SESSION["arduino_admin"])) {

    $userId = $_SESSION["arduino_admin"]["id"];
    $rs = Database::search(("SELECT * FROM `user` WHERE `id`='$userId'"));

    if ($rs->num_rows < 1) {
        header("Location:sign-in.php");
    }

    $userDetails = $rs->fetch_assoc();

?>


    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Manage Orders | Arduino Sri-Lanka</title>
        <link rel="icon" href="resources/logo/logo.png" />
        <link rel="stylesheet" href="style.css" />
        <link rel="stylesheet" href="bootstrap.css" />
        <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    </head>

    <body class="overflow-x-hidden admin-body2" onload="loadCustomerOrders(1);">

        <?php include "admin-header.php"; ?>

        <div class="row">

            <div class="col-1">
                <?php include "dashboard-sidebar.php"; ?>
            </div>

            <div class="container col-8">
                <div class="row">


                    <ul class="nav nav-tabs mt-4 d-none d-md-flex d-lg-flex">
                        <li class="nav-item">
                            <a class="nav-link" onclick="loadCustomerOrders(1);">Confirmed Orders</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" onclick="loadCustomerOrders(2);">Prepared Orders</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" onclick="loadCustomerOrders(3);">Shipped Orders</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" onclick="loadCustomerOrders(4);">Orders Received to Customer</a>
                        </li>
                    </ul>

                    <div class="dropdown d-lg-none d-md-none mt-4 text-end">
                        <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Select Orders Type
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#" onclick="loadCustomerOrders(1);">Confirmed Orders</a></li>
                            <li><a class="dropdown-item" href="#" onclick="loadCustomerOrders(2);">Prepared Orders</a></li>
                            <li><a class="dropdown-item" href="#" onclick="loadCustomerOrders(3);">Deliverd Orders</a></li>
                            <li><a class="dropdown-item" href="#" onclick="loadCustomerOrders(4);">Orders Received to Customer</a></li>
                        </ul>
                    </div>

                    <div id="orderContent">



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
    header("Location:sign-in.php");
}

?>