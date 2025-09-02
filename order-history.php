<?php

include "connection.php";
session_start();

if (isset($_SESSION["arduino_user"])) {

?>


    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Purchase History | Arduino Sri-Lanka</title>
        <link rel="icon" href="resources/logo/logo.png" />
        <link rel="stylesheet" href="style.css" />
        <link rel="stylesheet" href="bootstrap.css" />
        <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    </head>

    <body class="overflow-x-hidden" onload="loadPurchaseHistoryProcess(1);">

        <?php include "header.php" ?>

        <div class="container">

            <div class="row w-100 mt-3">
                <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                        <li class="breadcrumb-item"><a>Purchase History</a></li>
                    </ol>
                </nav>
            </div>

            <ul class="nav nav-tabs mt-4 d-none d-md-flex d-lg-flex">
                <li class="nav-item">
                    <a class="nav-link" onclick="loadPurchaseHistoryProcess(1);">All</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" onclick="loadPurchaseHistoryProcess(2);">To Ship</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" onclick="loadPurchaseHistoryProcess(3);">To Receive</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" onclick="loadPurchaseHistoryProcess(4);">Received</a>
                </li>
            </ul>

            <div id="purchaseHistoryContent">

            </div>

        </div>





        <?php
        include "footer.php";
        ?>

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