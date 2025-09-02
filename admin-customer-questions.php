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
        <title>Customer Questions | Arduino Sri-Lanka</title>
        <link rel="icon" href="resources/logo/logo.png" />
        <link rel="stylesheet" href="style.css" />
        <link rel="stylesheet" href="bootstrap.css" />
        <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <script src="bootstrap.bundle.min.js"></script>
    </head>

    <body class="overflow-x-hidden admin-body2" onload="loadQuestionProcess(1);">

        <?php include "admin-header.php" ?>

        <div class="row">

            <div class="col-1">
                <?php include "dashboard-sidebar.php" ?>
            </div>

            <div id="questionContent"  class="container col-8 mt-5">

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