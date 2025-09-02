<?php
session_start();
include "connection.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | Arduino Sri-Lanka</title>
    <link rel="icon" href="resources/logo/logo.png" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body class="overflow-x-hidden">

    <?php include "header.php" ?>

    <div class="container">
        <div class="row">
            <div class="col-10 offset-1 mt-5">

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

        </div>


        <div class="row d-flex align-content-center justify-content-center">


            <span class="mt-4 fs-3">Deals of the Day &RightArrow;</span>

            <button class="col-1 scroll-left bg-transparent" onclick="scrollMenuLeft();"><i class="bi bi-arrow-left"></i></button>
            <div class=" scrollable-menu col-10">

                <?php

                $rs = Database::search("SELECT * FROM `stock_view` WHERE `discount`!='none' ORDER BY `stock_view`.`stock_id` DESC LIMIT 8");
                $num = $rs->num_rows;

                for ($x = 0; $x < $num; $x++) {

                    $row = $rs->fetch_assoc();

                    $productId = $row["product_id"];

                    $image_rs = Database::search("SELECT `img_path` FROM `product_img` WHERE `product_id`='" . $productId . "' LIMIT 1");
                    $imgRow = $image_rs->fetch_assoc();

                ?>

                    <div class="card shadow col-5 col-md-4 col-lg-4 mx-2 my-2 menu-item">
                        <a class="link-dark text-decoration-none" href="single-product-view.php?product=<?php echo ($row["stock_id"]); ?>">
                            <img src="<?php echo ($imgRow["img_path"]); ?>" class="card-img-top rounded-top-4" alt="...">
                            <div class="card-body">
                                <h5 class="card-title fs-4"><?php echo ($row["name"]) ?></h5>
                                <p class="card-text text-truncate"><?php echo ($row["description"]) ?></p>
                                <?php

                                if ($row["discount"] != "none") {
                                    $discounted_price = $row["price"] - ($row["price"] * $row["discount"]) / 100;

                                ?>

                                    <h6 class="fw-bold text-primary-emphasis mb-1"><s>(Rs. <?php echo ($row["price"]); ?>.00)</s> - (<?php echo ($row["discount"]); ?>%)</h6>
                                    <h4 class="fw-bold text-warning-emphasis">Rs. <?php echo $discounted_price; ?>.00</h4>

                                <?php

                                } else {
                                ?>

                                    <h4 class="fw-bold text-warning-emphasis mb-3">Rs. <?php echo ($row["price"]); ?>.00</h4>

                                <?php
                                }

                                ?>
                            </div>
                        </a>
                    </div>

                <?php

                }

                ?>

            </div>

            <button class="scroll-right col-1 bg-transparent" onclick="scrollRight();"><i class="bi bi-arrow-right"></i></button>


            <span class="mt-4 fs-3">Popular With Customers &RightArrow;</span>


            <button class="col-1 scroll-left bg-transparent" onclick="scrollMenuLeft3();"><i class="bi bi-arrow-left"></i></button>
            <div class=" scrollable-menu3 col-10">

                <?php

                $rs = Database::search("SELECT `invoice_items`.`stock_id`,`stock_view`.`product_id`,`stock_view`.`name`,`stock_view`.`description`,`stock_view`.`price`,`stock_view`.`discount` 
                                        FROM `stock_view` INNER JOIN `invoice_items` ON `stock_view`.`stock_id`=`invoice_items`.`stock_id`
                                        GROUP BY `invoice_items`.`stock_id` ORDER BY SUM(`invoice_items`.`qty`) DESC LIMIT 8");
                $num = $rs->num_rows;

                for ($x = 0; $x < $num; $x++) {

                    $row = $rs->fetch_assoc();

                    $productId = $row["product_id"];

                    $image_rs = Database::search("SELECT `img_path` FROM `product_img` WHERE `product_id`='" . $productId . "' LIMIT 1");
                    $imgRow = $image_rs->fetch_assoc();

                ?>

                    <div class="card shadow col-5 col-md-4 col-lg-4 mx-2 my-2 menu-item">
                        <a class="link-dark text-decoration-none" href="single-product-view.php?product=<?php echo ($row["stock_id"]); ?>">
                            <img src="<?php echo ($imgRow["img_path"]); ?>" class="card-img-top rounded-top-4" alt="...">
                            <div class="card-body">
                                <h5 class="card-title fs-4"><?php echo ($row["name"]) ?></h5>
                                <p class="card-text text-truncate"><?php echo ($row["description"]) ?></p>

                                <?php

                                if ($row["discount"] != "none") {
                                    $discounted_price = $row["price"] - ($row["price"] * $row["discount"]) / 100;

                                ?>

                                    <h6 class="fw-bold text-primary-emphasis mb-1"><s>(Rs. <?php echo ($row["price"]); ?>.00)</s> - (<?php echo ($row["discount"]); ?>%)</h6>
                                    <h4 class="fw-bold text-warning-emphasis">Rs. <?php echo $discounted_price; ?>.00</h4>

                                <?php

                                } else {
                                ?>

                                    <h4 class="fw-bold text-warning-emphasis mb-3">Rs. <?php echo ($row["price"]); ?>.00</h4>

                                <?php
                                }

                                ?>
                            </div>
                        </a>
                    </div>

                <?php

                }

                ?>

            </div>

            <button class="scroll-right col-1 bg-transparent" onclick="scrollRight3();"><i class="bi bi-arrow-right"></i></button>



            <span class="mt-4 fs-3">Special Items &RightArrow;</span>


            <button class="col-1 scroll-left bg-transparent" onclick="scrollMenuLeft2();"><i class="bi bi-arrow-left"></i></button>
            <div class=" scrollable-menu2 col-10">

                <?php

                $rs = Database::search("SELECT * FROM `stock_view` WHERE `cat_name`='Special Items' ORDER BY `stock_view`.`stock_id` DESC LIMIT 8");
                $num = $rs->num_rows;

                for ($x = 0; $x < $num; $x++) {

                    $row = $rs->fetch_assoc();

                    $productId = $row["product_id"];

                    $image_rs = Database::search("SELECT `img_path` FROM `product_img` WHERE `product_id`='" . $productId . "' LIMIT 1");
                    $imgRow = $image_rs->fetch_assoc();

                ?>

                    <div class="card shadow col-5 col-md-4 col-lg-4 mx-2 my-2 menu-item">
                        <a class="link-dark text-decoration-none" href="single-product-view.php?product=<?php echo ($row["stock_id"]); ?>">
                            <img src="<?php echo ($imgRow["img_path"]); ?>" class="card-img-top rounded-top-4" alt="...">
                            <div class="card-body">
                                <h5 class="card-title fs-4"><?php echo ($row["name"]) ?></h5>
                                <p class="card-text text-truncate"><?php echo ($row["description"]) ?></p>

                                <?php

                                if ($row["discount"] != "none") {
                                    $discounted_price = $row["price"] - ($row["price"] * $row["discount"]) / 100;

                                ?>

                                    <h6 class="fw-bold text-primary-emphasis mb-1"><s>(Rs. <?php echo ($row["price"]); ?>.00)</s> - (<?php echo ($row["discount"]); ?>%)</h6>
                                    <h4 class="fw-bold text-warning-emphasis">Rs. <?php echo $discounted_price; ?>.00</h4>

                                <?php

                                } else {
                                ?>

                                    <h4 class="fw-bold text-warning-emphasis mb-3">Rs. <?php echo ($row["price"]); ?>.00</h4>

                                <?php
                                }

                                ?>
                            </div>
                        </a>
                    </div>

                <?php

                }

                ?>

            </div>

            <button class="scroll-right col-1 bg-transparent" onclick="scrollRight2();"><i class="bi bi-arrow-right"></i></button>



            <span class="mt-4 fs-3">For You &RightArrow;</span>


            <?php

            $rs = Database::search("SELECT * FROM `stock_view` ORDER BY `stock_view`.`stock_id` DESC LIMIT 15");
            $num = $rs->num_rows;

            for ($x = 0; $x < $num; $x++) {

                $row = $rs->fetch_assoc();

                $productId = $row["product_id"];

                $image_rs = Database::search("SELECT `img_path` FROM `product_img` WHERE `product_id`='" . $productId . "' LIMIT 1");
                $imgRow = $image_rs->fetch_assoc();

            ?>

                <div class="card shadow col-5 col-md-4 col-lg-3 mx-2 my-3">
                    <a class="link-dark text-decoration-none" href="single-product-view.php?product=<?php echo ($row["stock_id"]); ?>">
                        <img src="<?php echo ($imgRow["img_path"]); ?>" class="card-img-top rounded-top-4" alt="...">
                        <div class="card-body">
                            <h5 class="card-title fs-4"><?php echo ($row["name"]) ?></h5>
                            <p class="card-text text-truncate"><?php echo ($row["description"]) ?></p>
                            <?php

                            if ($row["discount"] != "none") {
                                $discounted_price = $row["price"] - ($row["price"] * $row["discount"]) / 100;

                            ?>

                                <h6 class="fw-bold text-primary-emphasis mb-1"><s>(Rs. <?php echo ($row["price"]); ?>.00)</s> - (<?php echo ($row["discount"]); ?>%)</h6>
                                <h4 class="fw-bold text-warning-emphasis">Rs. <?php echo $discounted_price; ?>.00</h4>

                            <?php

                            } else {
                            ?>

                                <h4 class="fw-bold text-warning-emphasis mb-3">Rs. <?php echo ($row["price"]); ?>.00</h4>

                            <?php
                            }

                            ?>
                        </div>
                    </a>
                </div>

            <?php

            }

            ?>


        </div>

        <div class="d-flex align-items-center justify-content-center text-center mt-4">
            <a class="special-button1 w-50 text-decoration-none" href="search.php">See All</a>
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