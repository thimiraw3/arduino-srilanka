<?php

include "connection.php";
session_start();

if (!isset($_GET["product"]) || empty($_GET["product"])) {
    header("Location: index.php");
}

$stockId = $_GET["product"];

$rs = Database::search("SELECT * FROM `stock_view` WHERE `stock_id` = '$stockId'");

if ($rs->num_rows < 1) {
?>
    <script>
        alert("Product Not Found!");
        window.location = "index.php";
    </script>
<?php
}

$row = $rs->fetch_assoc();
$productId = $row["product_id"];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo ($row["name"]); ?> | Arduino Sri-Lanka</title>
    <link rel="icon" href="resources/logo/logo.png" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body class="overflow-x-hidden">

    <?php include "header.php" ?>

    <div class="container">
        <div class="row w-100 mt-3">
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page"> <?php echo ($row["cat_name"]); ?></li>
                    <li class="breadcrumb-item active" aria-current="page"> <?php echo ($row["brand_name"]); ?></li>
                    <li class="breadcrumb-item active" aria-current="page"> <?php echo ($row["name"]); ?></li>
                </ol>
            </nav>
        </div>




        <div class="col-12">
            <div class="card shadow rounded-3">
                <div class="card-body row">

                    <div class="col-12 col-lg-5">
                        <!-- Container for the image gallery -->
                        <div class="container2 border rounded-3">

                            <?php
                            $image_rs = Database::search("SELECT * FROM `product_img` WHERE `product_id`='" . $productId . "'");
                            $image_num = $image_rs->num_rows;
                            $img = array();

                            if ($image_num != 0) {
                                for ($x = 0; $x < $image_num; $x++) {
                                    $image_data = $image_rs->fetch_assoc();
                                    $img[$x] = $image_data["img_path"];
                            ?>

                                    <!-- Full-width images with number text -->
                                    <div class="mySlides">
                                        <img src="<?php echo $img[$x]; ?>" style="width:100%">
                                    </div>

                            <?php
                                }
                            }
                            ?>

                            <!-- Next and previous buttons -->
                            <a class="prev bg-secondary-subtle" onclick="plusSlides(-1)"><i class="bi bi-arrow-left"></i></a>
                            <a class="next bg-secondary-subtle" onclick="plusSlides(1)"><i class="bi bi-arrow-right"></i></a>


                            <!-- Thumbnail images -->
                            <div class="row ms-1">

                                <?php
                                $image_rs = Database::search("SELECT * FROM `product_img` WHERE `product_id`='" . $productId . "'");
                                $image_num = $image_rs->num_rows;
                                $img = array();

                                if ($image_num != 0) {
                                    for ($x = 0; $x < $image_num; $x++) {
                                        $image_data = $image_rs->fetch_assoc();
                                        $img[$x] = $image_data["img_path"];
                                ?>

                                        <div class="border rounded-3" style="width:20%">
                                            <img class="demo cursor" src="<?php echo $img[$x]; ?>" style="width:100%" onload="currentSlide(<?php echo $x - 1 ?>)" onclick="currentSlide(<?php echo ($x + 1) ?>)">
                                        </div>

                                <?php
                                    }
                                }
                                ?>
                            </div>
                        </div>

                    </div>

                    <div class="col-10 col-lg-6 ms-lg-4 mt-4">
                        <h3 class="fw-bold text-color mb-1"><?php echo ($row["name"]); ?></h3>
                        <p class="text-muted"><?php echo ($row["description"]); ?></p>

                        <ul class="list-unstyled">
                            <li class="mb-2">Category: <?php echo ($row["cat_name"]); ?></li>
                            <li class="mb-2">Brand: <?php echo ($row["brand_name"]); ?></li>
                            <li class="mb-2">Warenty: <?php echo ($row["warenty"]); ?></li>
                        </ul>

                        <?php

                        if ($row["discount"] != "none") {
                            $discounted_price = $row["price"] - ($row["price"] * $row["discount"]) / 100;

                        ?>

                            <h6 class="fw-bold text-primary-emphasis mb-1"><s>(Rs. <?php echo ($row["price"]); ?>.00)</s> - (<?php echo ($row["discount"]); ?>%)</h6>
                            <h4 class="fw-bold text-primary-emphasis mb-3">Rs. <?php echo $discounted_price; ?>.00</h4>

                        <?php

                        } else {
                        ?>

                            <h4 class="fw-bold text-primary-emphasis mb-3">Rs. <?php echo ($row["price"]); ?>.00</h4>

                        <?php
                        }

                        ?>


                        <div class="d-flex align-items-center">
                            <input id="qty" class="form-control" placeholder="Qty" type="text" style="width: 100px;">

                            <?php
                            if ($row["qty"] > 0) {
                            ?>
                                <span class="ms-3 fw-bold text-bg-secondary rounded px-2 py-2"><?php echo ($row["qty"]); ?> Quantities Available</span>
                            <?php
                            } else {
                            ?>
                                <span class="ms-3 fw-bold text-bg-danger rounded px-2 py-2">Out of Stock</span>
                            <?php
                            }
                            ?>
                        </div>

                        <div class="row mt-4">
                            <div class="col-4 d-grid">
                                <button class="btn btn-warning fw-bold" onclick="addToCart(<?php echo ($row['stock_id']); ?>);">Add to Cart</button>
                            </div>

                            <div class="col-4 d-grid">
                                <button class="btn btn-light fw-bold" onclick="addToWishlist(<?php echo ($row['stock_id']); ?>);">
                                    <i class="bi bi-heart-fill"></i> Add to Wishlist</button>
                            </div>

                            <div class="col-4 d-grid ">
                                <a class="btn btn-info fw-bold" href="user-chat.php?productId=<?php echo $row['name']; ?> | "><i class="bi bi-chat-left-text"></i> &nbsp; Ask Questions</a>
                            </div>

                            <div class="col-12 d-grid mt-3">
                                <button class="btn btn-success fw-bold mb-2" onclick="buyNow(<?php echo $stockId; ?>);">Buy Now</button>
                                <h6>* All the products will be delivered to your address in billing details, Enter your address correctly.</h6>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>



        <div class="col-12 my-3">
            <div class="card shadow rounded-3">
                <div class="card-body">


                    <?php

                    $feedback_rs = Database::search("SELECT * FROM `feedback` INNER JOIN `user` ON 
                                                feedback.user_id = user.id WHERE `product_id`='" . $row["product_id"] . "'");

                    $feedback_num = $feedback_rs->num_rows;


                    if ($feedback_num > 0) {
                        $avgRs = Database::search("SELECT AVG(`rating`) AS `average_rating` FROM `feedback` WHERE product_id = '" . $row["product_id"] . "'");
                        $avgFeedback = $avgRs->fetch_assoc();
                    }

                    ?>

                    <div class="row">
                        <h3 class="fw-bold text-color mb-1 col-6">Product Reviews</h3>
                        <?php

                        if ($feedback_num > 0) {
                        ?>
                            <h3 class="col-6 text-end text-success">Avg. Rating - <?php echo number_format($avgFeedback["average_rating"], 1); ?>/5</h3>
                        <?php
                        }
                        ?>
                        <hr>
                    </div>
                    <?php

                    if ($feedback_num > 0) {



                        for ($y = 0; $y < $feedback_num; $y++) {
                            $feedback_data = $feedback_rs->fetch_assoc();

                    ?>

                            <div class="col-12 mt-1 mb-1 mx-1">
                                <div class="row border border-1 rounded me-0">

                                    <div class="col-6 mt-1 mb-1 ms-0"><?php echo $feedback_data["fname"] . " " . $feedback_data["lname"]; ?></div>
                                    <div class="col-6 mt-1 mb-1 me-0 text-end ">


                                        <?php

                                        if ($feedback_data["rating"] == 1) {
                                        ?>
                                            <span class="text-warning "><i class="bi bi-star-fill"></i></span>
                                            <span class="text-dark "><i class="bi bi-star-fill"></i></span>
                                            <span class="text-dark "><i class="bi bi-star-fill"></i></span>
                                            <span class="text-dark "><i class="bi bi-star-fill"></i></span>
                                            <span class="text-dark "><i class="bi bi-star-fill"></i></span>
                                        <?php
                                        } else if ($feedback_data["rating"] == 2) {
                                        ?>
                                            <span class="text-warning "><i class="bi bi-star-fill"></i></span>
                                            <span class="text-warning "><i class="bi bi-star-fill"></i></span>
                                            <span class="text-dark "><i class="bi bi-star-fill"></i></span>
                                            <span class="text-dark "><i class="bi bi-star-fill"></i></span>
                                            <span class="text-dark "><i class="bi bi-star-fill"></i></span>
                                        <?php
                                        } else if ($feedback_data["rating"] == 3) {
                                        ?>
                                            <span class="text-warning "><i class="bi bi-star-fill"></i></span>
                                            <span class="text-warning "><i class="bi bi-star-fill"></i></span>
                                            <span class="text-warning "><i class="bi bi-star-fill"></i></span>
                                            <span class="text-dark "><i class="bi bi-star-fill"></i></span>
                                            <span class="text-dark "><i class="bi bi-star-fill"></i></span>
                                        <?php
                                        } else if ($feedback_data["rating"] == 4) {
                                        ?>
                                            <span class="text-warning "><i class="bi bi-star-fill"></i></span>
                                            <span class="text-warning "><i class="bi bi-star-fill"></i></span>
                                            <span class="text-warning "><i class="bi bi-star-fill"></i></span>
                                            <span class="text-warning "><i class="bi bi-star-fill"></i></span>
                                            <span class="text-dark "><i class="bi bi-star-fill"></i></span>
                                        <?php
                                        } else if ($feedback_data["rating"] == 5) {
                                        ?>
                                            <span class="text-warning "><i class="bi bi-star-fill"></i></span>
                                            <span class="text-warning "><i class="bi bi-star-fill"></i></span>
                                            <span class="text-warning "><i class="bi bi-star-fill"></i></span>
                                            <span class="text-warning "><i class="bi bi-star-fill"></i></span>
                                            <span class="text-warning "><i class="bi bi-star-fill"></i></span>
                                        <?php
                                        }
                                        ?>


                                    </div>

                                    <div class="col-12 mt-2">
                                        <b>
                                            <?php echo $feedback_data["feedback"]; ?>
                                        </b>
                                    </div>
                                    <div class="offset-6 col-6 text-end">
                                        <label class="form-label fs-6 text-black-50"><?php echo $feedback_data["date"]; ?></label>
                                    </div>
                                </div>
                            </div>

                        <?php

                        }
                    } else {
                        ?>

                        <div class="col-12 my-4">
                            <h3 class="text-center fw-light">No Reviews Yet</h3>
                        </div>

                    <?php
                    }

                    ?>

                </div>
            </div>
        </div>


        <div class="row w-100">


            <span class="mt-4 fs-3">Related Products &RightArrow;</span>

            <button class="col-1 scroll-left bg-transparent" onclick="scrollMenuLeft();"><i class="bi bi-arrow-left"></i></button>
            <div class=" scrollable-menu col-10">

                <?php

                $rs = Database::search("SELECT * FROM `stock_view` WHERE `cat_id`='" . $row["cat_id"] . "' LIMIT 8");
                $num = $rs->num_rows;

                for ($x = 0; $x < $num; $x++) {

                    $row = $rs->fetch_assoc();

                    $productId = $row["product_id"];

                    $image_rs = Database::search("SELECT `img_path` FROM `product_img` WHERE `product_id`='" . $productId . "' LIMIT 1");
                    $imgRow = $image_rs->fetch_assoc();

                ?>

                    <div class="card shadow col-5 col-md-4 col-lg-3 mx-2 my-2 menu-item">
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


        </div>

    </div>




    <?php
    include "footer.php";
    ?>

    <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="script.js"></script>
    <script src="bootstrap.min.js"></script>
    <script src="bootstrap.bundle.js"></script>

</body>

</html>