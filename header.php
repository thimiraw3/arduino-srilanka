<?php
$search = "";
if (isset($_GET["search"])) {
    $search = $_GET["search"];
}
?>

<div class="row background-color">
    <div class="offset-1 col-7 align-self-start mt-2">

        <span class="text-lg-start text-light">Arduino Sri-Lanka 07XXXXXXXX / 07XXXXXXXX | </span>


        <span class="text-lg-start text-light">Help and Contact</span>

    </div>

    <div class="col-4 col-lg-3 d-flex align-content-end justify-content-end">

        <div class="row">

            <div class="dropdown">
                <button class="btn dropdown-toggle text-light" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    My Account
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="user-profile.php">My Profile</a></li>
                    <li><a class="dropdown-item" href="order-history.php">Purchase History</a></li>
                    <li><a class="dropdown-item" href="user-chat.php">Chat With Store</a></li>
                    <li><a class="dropdown-item" href="user-signout.php">Log Out</a></li>
                </ul>
            </div>

        </div>
    </div>
</div>


<!-- search -->
<form action="search.php" method="GET" class="row background-color">

    <div class="col-1 my-2 me-2 offset-1  offset-lg-1 d-grid ">

        <button class="btn border border-1 border-dark" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBothOptions" aria-controls="offcanvasWithBothOptions"><i class="bi bi-list"></i></button>

    </div>

    <div class="col-4 col-lg-5 my-2 d-grid">

        <div class="form-floating">
            <input type="text" class="form-control" name="search" placeholder="Search..." value="<?php echo ($search); ?>" id="search" />
            <label for="search">Search</label>
        </div>

    </div>

    <div class="col-2 my-2 d-grid">
        <button type="submit" class="btn btn-secondary" onclick="search();"><i class="bi bi-search"></i> SEARCH</button>
    </div>
    <div class="col-1 my-2 d-grid">
        <a href="wishlist.php" class="btn bg-info-subtle border align-content-center" onclick="header"><i class="bi bi-heart text-dark"></i></a>
    </div>
    <div class="col-1 my-2 d-grid">
        <a href="cart.php" class="btn bg-success-subtle border align-content-center" ><i class="bi bi-cart-fill text-dark"></i></a>
    </div>
</form>
<!-- search -->

<div class="row background-color d-lg-flex">
    <div class="col-10 offset-1 my-2 d-flex align-content-end justify-content-center gap-5">

        <a href="home.php" class="text-decoration-none text-light">Home</a>
        <a href="search.php" class="text-decoration-none text-light">Advanced Search</a>
        <a class="text-decoration-none text-light" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBothOptions" aria-controls="offcanvasWithBothOptions">Shop By Category</a>
        <a href="contact-us.php" class="text-decoration-none text-light">Contact Us</a>
        <a href="onsale.php" class="text-decoration-none text-light">On Sale</a>

    </div>
</div>



<!-- offcanvas -->
<div class="offcanvas offcanvas-start" data-bs-scroll="true" tabindex="-1" id="offcanvasWithBothOptions" aria-labelledby="offcanvasWithBothOptionsLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasWithBothOptionsLabel">Product Categories</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">

        <?php

        $catRs = Database::search("SELECT * FROM `category` WHERE `status`='1'");
        $num2 = $catRs->num_rows;

        for ($x = 0; $x < $num2; $x++) {

            $catrow = $catRs->fetch_assoc();

        ?>

            <div class="row mb-3">
                <hr>
                <a href="search-by-category.php?catId=<?php echo ($catrow["cat_id"]); ?>" class="text-decoration-none text-dark"><?php echo ($catrow["cat_name"]); ?></a>
            </div>

        <?php
        }
        ?>
    </div>
</div>
<!-- offcanvas -->