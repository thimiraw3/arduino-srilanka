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
        <title>Admin Message | Arduino Sri-Lanka</title>
        <link rel="icon" href="resources/logo/logo.png" />
        <link rel="stylesheet" href="style.css" />
        <link rel="stylesheet" href="bootstrap.css" />
        <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    </head>

    <body class="overflow-x-hidden admin-body2" onload="loadChats(0);">

        <?php include "admin-header.php" ?>

        <div class="row">

            <div class="col-1">
                <?php include "dashboard-sidebar.php" ?>
            </div>

            <div class="col-11 mt-5">
                <div class="row">
                    <div class="col-9 col-md-4 col-lg-4 card shadow rounded-3 mt-3 offset-2 offset-lg-0 offset-md-0">
                    <ul class="nav nav-tabs mt-1">
                        <li class="nav-item">
                            <a class="nav-link" onclick="loadChats(0);">New</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" onclick="loadChats(1);">Recent</a>
                        </li>
                    </ul>
                        <div class="card-body overflow-auto row align-items-start" style="height: 50dvh;" id="adminChatContent">

                            

                        </div>
                    </div>
                    <div class="col-10 col-md-7 col-lg-7 ms-2 card shadow rounded-3 mt-3">
                        <div class="card-body">

                            <div id="scrollMsg" style="height: 50dvh;" class="overflow-auto row align-items-end">
                                <div id="adminMessages" class="message"></div>
                            </div>
                            <div class="input-container">
                                <input class="form-control" type="text" id="adminMessageInput" placeholder="Type a message...">
                                <button onclick="sendAdminMessage()">Send</button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php
        include "admin-footer.php";
        ?>


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