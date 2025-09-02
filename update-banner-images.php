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
        <title>Update Banner | Arduino Sri-Lanka</title>
        <link rel="icon" href="resources/logo/logo.png" />
        <link rel="stylesheet" href="style.css" />
        <link rel="stylesheet" href="bootstrap.css" />
        <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    </head>

    <body class="overflow-x-hidden admin-body2">

        <?php include "admin-header.php" ?>

        <div class="row">

            <div class="col-1">
                <?php include "dashboard-sidebar.php" ?>
            </div>

            <div class="col-9 col-lg-11 mt-5 offset-2 offset-lg-0">

                <div class="row">
                    <div class="col-12 offset-1 mt-4">
                        <label class="form-label fs-2">Preview</label>
                    </div>
                    <div class="col-12 col-md-8 col-lg-8 offset-2 mt-2">

                        <?php

                        $bannerRs = Database::search("SELECT * FROM `banners` WHERE `type`='banner'");
                        $bannerNum = $bannerRs->num_rows;

                        ?>

                        <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                <?php

                                for ($x = 0; $x < $bannerNum; $x++) {
                                    $banners = $bannerRs->fetch_assoc();

                                ?>

                                    <div class="carousel-item active">
                                        <img src="<?php echo $banners["path"]; ?>" class="d-block rounded-3 w-100" alt="...">
                                    </div>

                                <?php
                                }

                                ?>
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>


                    <div class="row">
                    <div class="col-12 offset-1 mt-4">
                        <label class="form-label fs-2">Add Banner Images</label>
                    </div>
                    <div class="offset-lg-3 col-12 col-lg-6">
                        <div class="row">
                            <div class="col-12 border border-primary rounded d-flex justify-content-center">
                                <img src="resources/addImg.png" class="img-fluid" id="bannerImg" />
                            </div>
                        </div>
                    </div>
                    <div class="offset-lg-3 col-12 col-lg-6 d-grid mt-3">
                        <input type="file" class="d-none" id="bannerimageuploader" onclick="changeBannerImage();" />
                        <label for="bannerimageuploader" class="col-6 btn btn-primary offset-3">Upload Image</label>
                        <button class="btn btn-success btn-lg mt-4" onclick="addBannerImage();">Save Images</button>
                    </div>
                </div>


                    <div class="row">
                        <div class="col-12 offset-1 mt-4">
                            <label class="form-label fs-2">Delete Banner Images</label>
                        </div>
                        <div class="col-12 col-lg-6 offset-lg-3">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Process</th>
                                    </tr>
                                </thead>
                                <tbody class="table-group-divider">
                                    <?php
                                    $bannerRs2 = Database::search("SELECT * FROM `banners` WHERE `type`='banner'");
                                    $bannerNum2 = $bannerRs2->num_rows;

                                    for ($i = 0; $i < $bannerNum2; $i++) {
                                        $banners2 = $bannerRs2->fetch_assoc();
                                    ?>

                                        <tr>
                                            <td><img src="<?php echo $banners2["path"]; ?>" class="d-block rounded-3 w-100" alt="..."></td>
                                            <td>
                                                <button class="btn btn-danger mt-5" onclick="deleteBannerImage(<?php echo $banners2['banner_id']; ?>);">Delete Banner</button>
                                            </td>

                                        </tr>

                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
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