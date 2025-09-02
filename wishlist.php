<?php

include "connection.php";
session_start();

if (isset($_SESSION["arduino_user"])) {

    $userId = $_SESSION["arduino_user"]["id"];
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
        <title>Wishlist | Arduino Sri-Lanka</title>
        <link rel="icon" href="resources/logo/logo.png" />
        <link rel="stylesheet" href="style.css" />
        <link rel="stylesheet" href="bootstrap.css" />
        <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    </head>

    <body onload="loadWishlistProcess();" class="overflow-x-hidden">

        <?php include "header.php" ?>


        <div class="container">

            <div class="row w-100 mt-3">
                <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                        <li class="breadcrumb-item"><a>Wishlist</a></li>
                    </ol>
                </nav>
            </div>

            <div class="col-12 mb-3">
                <span class="fs-1">Wishlist &nbsp; <i class="bi bi-heart-fill fs-2"></i> </span>
            </div>

            <div class="row" id="wishlistContent">

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