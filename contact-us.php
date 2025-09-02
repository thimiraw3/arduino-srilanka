<?php

include "connection.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us | Arduino Sri-Lanka</title>
    <link rel="icon" href="resources/logo/logo.png" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body class="overflow-x-hidden">

    <?php include "header.php" ?>


    <div class="container mt-3" id="catSearchResults">

        <div class="row mt-3">

            <span class="fs-2 mb-2">Contact Us &RightArrow; </span>

            <div class="col-12 card shadow rounded-3 mb-4">
                <div class="card-body row">
                    <div class="col-6">
                        <label class="fs-4">Call Us On:</label>
                        <p class="fs-5">07XXXXXXXX/07XXXXXXXX</p>
                        <p>You can call us on weekdays 9.00 a.m. to 5.00 p.m.</p>
                    </div>
                    <div class="col-6">
                        <label class="fs-4">Contact Us On WhatsApp:</label>
                        <p class="fs-5 text-success">07XXXXXXXX/07XXXXXXXX</p>
                    </div>
                    <div class="col-6">
                        <label class="fs-4">Our Email:</label>
                        <p class="fs-2">arduino-srilanka@gmail.com</p>
                    </div>
                </div>
            </div>


            <span class="fs-2 mb-2">Leave Us A Message &RightArrow; </span>

            <div class="col-12 card shadow rounded-3">
                <div class="card-body row">
                    <label class="form-label fs-3" for="">Full Name</label>
                    <div class="mb-2 col-6">
                        <label class="form-label" for="">First Name</label>
                        <input class="form-control" type="text" id="fName">
                    </div>

                    <div class="mb-2 col-6">
                        <label class="form-label" for="">Last Name</label>
                        <input class="form-control" type="text" id="lName">
                    </div>

                    <div class="mb-2 col-12">
                        <label class="form-label" for="">Email</label>
                        <input class="form-control" type="text" id="email">
                    </div>

                    <div class="mb-2 col-12">
                        <label class="form-label" for="">Message for Us</label>
                        <textarea class="form-control" type="text" rows="5" id="message"></textarea>
                    </div>

                    <div class="d-grid mt-2 fw-bold">
                        <button class="special-button1 fw-bold" onclick="saveMsg();">SEND</button>
                    </div>

                </div>
            </div>

        </div>

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