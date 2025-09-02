<?php

session_start();

if (isset($_SESSION["arduino_admin"])) {
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>User Management | Arduino Sri-Lanka</title>
        <link rel="icon" href="resources/logo/logo.png" />
        <link rel="stylesheet" href="style.css" />
        <link rel="stylesheet" href="bootstrap.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    </head>

    <body onload="loadUsers(1);">


        <?php include "admin-header.php"; ?>

        <div class="container admin-body">
            <div class="row d-flex justify-content-center">

                <div class="col-6">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" id="adminUserSearch" placeholder="search by Name,Email or mobile" aria-label="Recipient's username" aria-describedby="button-addon2">
                        <button class="btn btn-outline-dark" type="button" id="button-addon2" onclick="loadUsers(1);">Search</button>
                    </div>
                </div>

                <div class="col-10">
                    <h2 class="text-center">User Management</h2>
                    
                    <div class="mt-4 table-responsive" id="content">



                    </div>
                </div>
            </div>
        </div>



        <?php include "admin-footer.php"; ?>

        <script src="script.js"></script>
        <script src="bootstrap.min.js"></script>

    </body>

    </html>



<?php

} else {
    header("Location: admin-signin.php");
}

?>