<span class="fs-2">Products On Sale &RightArrow; </span>

<div class="row d-flex justify-content-center">

    <?php

    include "connection.php";

    $page = 1;
    if (isset($_GET["page"]) && $_GET["page"] > 1) {
        $page = $_GET["page"];
    }


    $rs = Database::search("SELECT * FROM `stock_view` WHERE `discount` != 'none' AND `status`='1'");
    $num = $rs->num_rows;

    $resultsPerPage = 10;
    $noOfPages = ceil($num / $resultsPerPage);
    $pageResults = ($page - 1) * $resultsPerPage;


    $rs2 = Database::search("SELECT * FROM `stock_view` WHERE `discount` != 'none' AND `status`='1' LIMIT $resultsPerPage OFFSET $pageResults");
    $num2 = $rs2->num_rows;

    if ($num2 > 0) {

        for ($x = 0; $x < $num2; $x++) {

            $row = $rs2->fetch_assoc();

            $productId = $row["product_id"];

            $image_rs2 = Database::search("SELECT `img_path` FROM `product_img` WHERE `product_id`='" . $productId . "'");
            $image_data2 = $image_rs2->fetch_assoc();

    ?>

            <div class="card shadow col-5 col-md-3 col-lg-3 mx-2 my-2 menu-item">
                <a class="link-dark text-decoration-none" href="single-product-view.php?product=<?php echo ($row["stock_id"]); ?>">
                    <img src="<?php echo ($image_data2["img_path"]); ?>" class="card-img-top rounded-top-4" alt="...">
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
                        <li class="page-item active"><span class="page-link" onclick="loadProductsOnSale(<?php echo ($x); ?>,<?php echo ($catId) ?>);"><?php echo ($x); ?></span></li>
                    <?php
                    } else {
                    ?>
                        <li class="page-item"><span class="page-link" onclick="loadProductsOnSale(<?php echo ($x); ?>,<?php echo ($catId) ?>);"><?php echo ($x); ?></span></li>
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