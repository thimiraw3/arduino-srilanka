<?php

include "connection.php";

if (!isset($_GET["catId"]) || empty($_GET["catId"])) {
    header("Location: home.php");
}

$catId = $_GET["catId"];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search By Category | Arduino Sri-Lanka</title>
    <link rel="icon" href="resources/logo/logo.png" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body class="overflow-x-hidden">

    <?php include "header.php" ?>


    <div class="container" id="catSearchResults">


        <span class="fs-2">Search By Category &RightArrow; </span>

        <div class="row d-flex justify-content-center">

            <?php

            $page = 1;
            if (isset($_GET["page"]) && $_GET["page"] > 1) {
                $page = $_GET["page"];
            }


            $rs = Database::search("SELECT * FROM `stock_view` WHERE `cat_id` = '$catId' AND `status`='1'");
            $num = $rs->num_rows;

            $resultsPerPage = 10;
            $noOfPages = ceil($num / $resultsPerPage);
            $pageResults = ($page - 1) * $resultsPerPage;


            $rs2 = Database::search("SELECT * FROM `stock_view` WHERE `cat_id` = '$catId' AND `status`='1' LIMIT $resultsPerPage OFFSET $pageResults");
            $num2 = $rs2->num_rows;

            if ($num2 > 0) {

                for ($x = 0; $x < $num2; $x++) {

                    $row = $rs2->fetch_assoc();

                    $productId = $row["product_id"];

                    $image_rs2 = Database::search("SELECT `img_path` FROM `product_img` WHERE `product_id`='" . $productId . "'");
                    $image_data2 = $image_rs2->fetch_assoc();

            ?>

                    <div class="card shadow col-5 col-md-4 col-lg-3 mx-3 my-3">
                        <a class="link-dark text-decoration-none" href="single-product-view.php?product=<?php echo ($row["stock_id"]); ?>">
                            <img src="<?php echo ($image_data2["img_path"]); ?>" class="card-img-top rounded-top-4" alt="<?php echo ($image_data2["img_path"]); ?>">
                            <div class="card-body">
                                <h5 class="card-title fs-4"><?php echo ($row["name"]); ?></h5>
                                <p class="card-text text-truncate"><?php echo ($row["description"]); ?></p>
                                <p class="card-text fs-5 fw-bold text-warning-emphasis">Rs. <?php echo ($row["price"]); ?>.00</p>
                            </div>
                        </a>
                    </div>

                <?php

                }
            } else {

                ?>

                <div class="col-12 text-center mt-5">
                    <i class="bi bi-exclamation-triangle-fill text-danger" style="font-size: 150px;"></i>
                    <h2 class="text-danger fw-bold">No Products Found!</h2>
                    <span class="text-muted">No matching products were found for this category.</span>
                </div>

            <?php
            }

            ?>

        </div>


        <?php

        if ($num2 > 0) {

        ?>

            <div class="d-flex justify-content-center mb-3">
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <li class="page-item">
                            <a class="page-link" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>

                        <?php

                        for ($x = 1; $x <= $noOfPages; $x++) {
                            if ($x == $page) {
                        ?>
                                <li class="page-item active"><span class="page-link" onclick="categorySearch(<?php echo ($x); ?>,<?php echo ($catId) ?>);"><?php echo ($x); ?></span></li>
                            <?php
                            } else {
                            ?>
                                <li class="page-item"><span class="page-link" onclick="categorySearch(<?php echo ($x); ?>,<?php echo ($catId) ?>);"><?php echo ($x); ?></span></li>
                        <?php
                            }
                        }

                        ?>


                        <li class="page-item">
                            <a class="page-link" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        <?php

        }

        ?>


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