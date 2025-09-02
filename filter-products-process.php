<?php

include "connection.php";

$page = 1;
if (isset($_POST["page"]) && $_POST["page"] > 1) {
    $page = $_POST["page"];
}


$category = $_POST["category"];
$brand = $_POST["brand"];
$pf = $_POST["priceFrom"];
$pt = $_POST["priceTo"];
$search = $_POST["search"];
$page = $_POST["page"];
$sort = $_POST["sort"];

?>

<!-- filter form -->
<div class="col-12">
    <div class="card shadow rounded-3">
        <div class="card-body row">
            <h2><i class="bi bi-funnel-fill fs-2"></i> Filter Products</h2>
            <hr>



            <div class="mb-2 col-6">
                <label class="form-label" for="">Category</label>
                <select class="form-select" id="category">
                    <option value="0">Select Category</option>

                    <?php
                    $rs = Database::search("SELECT * FROM `category`");
                    $num = $rs->num_rows;

                    for ($x = 0; $x < $num; $x++) {
                        $d = $rs->fetch_assoc();
                    ?>
                        <option value="<?php echo ($d["cat_id"]); ?>" <?php if ($category == $d["cat_id"]) {
                                                                            echo ("selected");
                                                                        } ?>><?php echo ($d["cat_name"]); ?></option>
                    <?php
                    }

                    ?>
                </select>
            </div>

            <div class="mb-2 col-6">
                <label class="form-label" for="">Brand</label>
                <select class="form-select" id="brand">
                    <option value="0">Select Brand</option>
                    <?php
                    $rs = Database::search("SELECT * FROM `brand`");
                    $num = $rs->num_rows;

                    for ($x = 0; $x < $num; $x++) {
                        $d = $rs->fetch_assoc();
                    ?>
                        <option value="<?php echo ($d["brand_id"]); ?>" <?php if ($brand == $d["brand_id"]) {
                                                                            echo ("selected");
                                                                        } ?>><?php echo ($d["brand_name"]); ?></option>
                    <?php
                    }

                    ?>
                </select>
            </div>

            <div class="mb-2 col-6">
                <label class="form-label" for="">Price From</label>
                <input class="form-control" type="text" id="priceFrom" value="<?php echo ($pf); ?>">
            </div>

            <div class="mb-2 col-6">
                <label class="form-label" for="">Price To</label>
                <input class="form-control" type="text" id="priceTo" value="<?php echo ($pt); ?>">
            </div>

            <div class="d-grid mt-2 fw-bold">
                <button class="special-button1 fw-bold" onclick="filter(1);">FILTER</button>
            </div>

        </div>
    </div>
</div>


<div class="col-12 d-flex align-content-end justify-content-end">
    <div class="my-2 col-3 text-end ">
        <label class="form-label fs-4" for="">Sort By</label>
        <select class="form-select" id="sort" onchange="filter(1);">
            <option value="0" <?php if ($sort == "0") {
                                    echo ("selected");
                                } ?>>none</option>
            <option value="1" <?php if ($sort == "1") {
                                    echo ("selected");
                                } ?>>Price Low to high</option>
            <option value="2" <?php if ($sort == "2") {
                                    echo ("selected");
                                } ?>>Price high to low</option>

        </select>
    </div>
</div>

<!-- filter form -->

<div class="col-12 offset-1 col-md-0 offset-md-0">
    <div class="row d-flex justify-content-center">

        <?php


        $query = "SELECT * FROM `stock_view` ";

        $conditions = [];

        //Filter by text
        if (!empty($search)) {
            $conditions[] = "`name` LIKE '%$search%'";
        }

        // Filter by category
        if ($category != 0) {
            $conditions[] = "`cat_id` = '$category'";
        }

        // Filter by brand
        if ($brand != 0) {
            $conditions[] = "`brand_id` = '$brand'";
        }

        // Filter by price from
        if (!empty($pf) && empty($pt)) {
            $conditions[] = "`price` >= '$pf'";
        }

        // Filter by price to
        if (empty($pf) && !empty($pt)) {
            $conditions[] = "`price` <= '$pt'";
        }

        // Filter by price range
        if (!empty($pf) && !empty($pt)) {
            $conditions[] = "`price` BETWEEN '$pf' AND '$pt'";
        }

        if (!empty($conditions)) {
            $query .= " WHERE " . implode(" AND ", $conditions);
        }

        if (empty($conditions)) {
            $query .= " WHERE `status` = '1'";
        } else {
            $query .= " AND `status`='1'";
        }

        //sort by price ASC
        if ($sort == 1) {
            $query .= " ORDER BY `price` ASC ";
        }

        //sort by price DESC
        if ($sort == 2) {
            $query .= " ORDER BY `price` DESC";
        }

        $rs = Database::search($query);
        $num = $rs->num_rows;

        $resultsPerPage = 4;
        $noOfPages = ceil($num / $resultsPerPage);
        $pageResults = ($page - 1) * $resultsPerPage;

        $query .= " LIMIT $resultsPerPage OFFSET $pageResults";

        $rs2 = Database::search($query);
        $num2 = $rs->num_rows;

        if ($num2 > 0) {

            for ($x = 0; $x < $num2; $x++) {
                $row = $rs2->fetch_assoc();
                
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
                            <p class="card-text fs-5 fw-bold text-warning-emphasis">Rs. <?php echo ($row["price"]) ?>.00</p>
                        </div>
                    </a>
                </div>

            <?php

            }
        } else {

            ?>

            <div class="col-12 text-center mt-2">
                <i class="bi bi-exclamation-triangle-fill text-danger" style="font-size: 150px;"></i>
                <h2 class="text-danger fw-bold">No Products Found!</h2>
                <span class="text-muted">No matching products were found for the search text you have entered.</span>
            </div>

        <?php
        }
        ?>
    </div>
</div>

<?php

if ($num2 > 0) {

?>

    <div class="col-12 d-flex justify-content-center mb-3">
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
                        <li class="page-item active"><span class="page-link" onclick="filter(<?php echo ($x); ?>);"><?php echo ($x); ?></span></li>
                    <?php
                    } else {
                    ?>
                        <li class="page-item"><span class="page-link" onclick="filter(<?php echo ($x); ?>);"><?php echo ($x); ?></span></li>
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