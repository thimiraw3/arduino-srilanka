<?php

include "connection.php";
session_start();

if (isset($_SESSION["arduino_admin"])) {
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Product Management | Arduino Sri-Lanka</title>
        <link rel="icon" href="resources/logo/logo.png" />
        <link rel="stylesheet" href="style.css" />
        <link rel="stylesheet" href="bootstrap.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">
    </head>

    <body onload="loadProducts(1);">

        <?php include "admin-header.php"; ?>

        <div class="container admin-body">
            <div class="row d-flex justify-content-center">

                <div class="col-lg-6 col-md-8 col-10">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" id="productSearchTxt" placeholder="search by Name,Category or Brand" aria-label="Recipient's username" aria-describedby="button-addon2">
                        <button class="btn btn-outline-dark" type="button" id="button-addon2" onclick="loadProducts(1);">Search</button>
                    </div>
                </div>

                <div class="col-10">

                    <div class="row my-3">
                        <h2 class="col-6">Product Management</h2>

                        <div class="col-6 text-end">
                            <button class="special-button1" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBothOptions" aria-controls="offcanvasWithBothOptions">
                                Manage New Items
                            </button>
                        </div>
                    </div>


                    <div class="offcanvas offcanvas-start" data-bs-scroll="true" tabindex="-1" id="offcanvasWithBothOptions" aria-labelledby="offcanvasWithBothOptionsLabel">
                        <div class="offcanvas-header">
                            <h3 class="offcanvas-title" id="offcanvasWithBothOptionsLabel">Manage Items</h3>
                            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                        </div>
                        <div class="offcanvas-body">
                            <div>
                                <h5 class="my-3">Manage New Products</h5>
                                <button class="btn btn-primary w-100 mb-2 mb-4" data-bs-toggle="modal" data-bs-target="#registerProductModal">Register Product</button>

                                <h5 class="my-3">Manage Brands</h5>
                                <button class="btn btn-secondary w-100 mb-2" data-bs-toggle="modal" data-bs-target="#registerBrandModal">Add Brand</button>

                                <div class="d-flex justify-content-center mb-4">
                                    <button class="btn btn-outline-secondary w-75 mb-2 me-1" data-bs-toggle="modal" data-bs-target="#updateBrandModal">Edit Brand</button>
                                </div>

                                <h5 class="my-3">Manage Categories</h5>
                                <button class="btn btn-success w-100 mb-2" data-bs-toggle="modal" data-bs-target="#registerCategoryModal">Add Category</button>
                                <div class="d-flex justify-content-center mb-4">
                                    <button class="btn btn-outline-success w-75 mb-2 me-1" data-bs-toggle="modal" data-bs-target="#updateCatModal">Edit Category</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4 table-responsive" id="content">


                    </div>

                    <?php include "admin-footer.php"; ?>
                </div>

            </div>

        </div>



        <!-- Register Product Modal -->
        <div class="modal fade" id="registerProductModal" tabindex="-1" aria-hidden="false">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Register Product</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-2">
                            <label class="form-label" for="">Product Name</label>
                            <input id="productName" class="form-control" type="text" />
                        </div>
                        <div class="mb-2">
                            <label class="form-label" for="">Product Description</label>
                            <textarea class="form-control" id="productDesc" rows="5"></textarea>
                        </div>

                        <div class="mb-2">
                            <label class="form-label" for="">Category</label>
                            <select class="form-select" id="productCategory">
                                <option value="0">Select Category</option>
                                <?php
                                $rs = Database::search("SELECT * FROM `category`");
                                $num = $rs->num_rows;

                                for ($x = 0; $x < $num; $x++) {
                                    $d = $rs->fetch_assoc();
                                ?>
                                    <option value="<?php echo ($d["cat_id"]); ?>"><?php echo ($d["cat_name"]); ?></option>
                                <?php
                                }

                                ?>

                            </select>
                        </div>

                        <div class="mb-2">
                            <label class="form-label" for="">Brand</label>
                            <select class="form-select" id="productBrand">
                                <option value="0">Select Brand</option>

                                <?php
                                $rs = Database::search("SELECT * FROM `brand`");
                                $num = $rs->num_rows;

                                for ($x = 0; $x < $num; $x++) {
                                    $d = $rs->fetch_assoc();
                                ?>
                                    <option value="<?php echo ($d["brand_id"]); ?>"><?php echo ($d["brand_name"]); ?></option>
                                <?php
                                }

                                ?>

                            </select>
                        </div>

                        <div class="col-12">
                            <div class="row">
                                <div class="col-12">
                                    <label class="form-label">Add Product Images</label>
                                </div>
                                <div class="offset-lg-3 col-12 col-lg-6">
                                    <div class="row">
                                        <div class="col-4 border border-primary rounded">
                                            <img src="resources/addproductimg.svg" class="img-fluid" style="width: 250px;" id="i0" />
                                        </div>
                                        <div class="col-4 border border-primary rounded">
                                            <img src="resources/addproductimg.svg" class="img-fluid" style="width: 250px;" id="i1" />
                                        </div>
                                        <div class="col-4 border border-primary rounded">
                                            <img src="resources/addproductimg.svg" class="img-fluid" style="width: 250px;" id="i2" />
                                        </div>
                                    </div>
                                </div>
                                <div class="offset-lg-3 col-12 col-lg-6 d-grid mt-3">
                                    <input type="file" class="d-none" multiple id="imageuploader" />
                                    <label for="imageuploader" class="col-12 btn btn-primary" onclick="changeProductImage();">Upload Images</label>
                                </div>
                            </div>
                        </div>



                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="registerProduct();">REGISTER</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Register Product Modal -->


        <!-- Update Product Modal -->
        <div class="modal fade" id="updateProductModal" tabindex="-1" aria-hidden="false">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Update Product</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-2">
                            <label class="form-label" for="">Product ID</label>
                            <input id="uProdId" class="form-control" type="text" disabled />
                        </div>
                        <div class="mb-2">
                            <label class="form-label" for="">Product Name</label>
                            <input id="uProdName" class="form-control" type="text" />
                        </div>
                        <div class="mb-2">
                            <label class="form-label" for="">Product Description</label>
                            <textarea class="form-control" id="uProdDesc" rows="5"></textarea>
                        </div>

                        <div class="mb-2">
                            <label class="form-label" for="">Category</label>
                            <select class="form-select" id="uProdCategory">
                                <option value="0">Select Category</option>
                                <?php
                                $rs = Database::search("SELECT * FROM `category`");
                                $num = $rs->num_rows;

                                for ($x = 0; $x < $num; $x++) {
                                    $d = $rs->fetch_assoc();
                                ?>
                                    <option value="<?php echo ($d["cat_id"]); ?>"><?php echo ($d["cat_name"]); ?></option>
                                <?php
                                }

                                ?>

                            </select>
                        </div>

                        <div class="mb-2">
                            <label class="form-label" for="">Brand</label>
                            <select class="form-select" id="uProdBrand">
                                <option value="0">Select Brand</option>

                                <?php
                                $rs = Database::search("SELECT * FROM `brand`");
                                $num = $rs->num_rows;

                                for ($x = 0; $x < $num; $x++) {
                                    $d = $rs->fetch_assoc();
                                ?>
                                    <option value="<?php echo ($d["brand_id"]); ?>"><?php echo ($d["brand_name"]); ?></option>
                                <?php
                                }

                                ?>

                            </select>
                        </div>

                        <div class="col-12">
                            <div class="row">
                                <div class="col-12">
                                    <label class="form-label">Add Product Images</label>
                                </div>
                                <div class="offset-lg-3 col-12 col-lg-6">
                                    <div class="row">
                                        <div class="col-4 border border-primary rounded">
                                            <img src="resources/addproductimg.svg" class="img-fluid" style="width: 250px;" id="ui0" />
                                        </div>
                                        <div class="col-4 border border-primary rounded">
                                            <img src="resources/addproductimg.svg" class="img-fluid" style="width: 250px;" id="ui1" />
                                        </div>
                                        <div class="col-4 border border-primary rounded">
                                            <img src="resources/addproductimg.svg" class="img-fluid" style="width: 250px;" id="ui2" />
                                        </div>
                                    </div>
                                </div>
                                <div class="offset-lg-3 col-12 col-lg-6 d-grid mt-3">
                                    <input type="file" class="d-none" multiple id="uImageUploader" />
                                    <label for="uImageUploader" class="col-12 btn btn-primary" onclick="updateProductImage();">Upload Images</label>
                                </div>
                            </div>
                        </div>



                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="updateProduct();">UPDATE</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Update Product Modal -->


        <!-- category Modal -->
        <div class="modal fade" id="registerCategoryModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5">Register New Category</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-2">
                            <label class="form-label" for="">Category Name</label>
                            <input id="categoryName" class="form-control" type="text" />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="registerCategory();">REGISTER</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- category Modal -->


        <!-- Brand Modal -->
        <div class="modal fade" id="registerBrandModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5">Register New Brand</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-2">
                            <label class="form-label" for="">Brand Name</label>
                            <input id="brandName" class="form-control" type="text" />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="registerBrand();">REGISTER</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Brand Modal -->

        <!-- Update Category Modal -->
        <div class="modal fade" id="updateCatModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5">Update Category</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body col-12">
                        <table class="table table-striped align-middle">
                            <thead>
                                <tr>
                                    <th>Category Name</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody class="table-group-divider">

                                <?php
                                $rs1 = Database::search("SELECT * FROM `category`");
                                $num1 = $rs1->num_rows;

                                for ($x1 = 0; $x1 < $num1; $x1++) {
                                    $d1 = $rs1->fetch_assoc();
                                ?>
                                    <tr>
                                        <td><?php echo $d1["cat_name"]; ?></td>
                                        <td><?php

                                            if ($d1["status"] == '1') {
                                            ?>

                                                <button class="col-8 offset-2 btn btn-sm col btn-success fw-bold" onclick="changeCategoryStatus(<?php echo ($d1['cat_id']); ?>);">Active</button>

                                            <?php
                                            } else {
                                            ?>

                                                <button class="col-8 offset-2 btn btn-sm btn-danger fw-bold" onclick="changeCategoryStatus(<?php echo ($d1['cat_id']); ?>);">Deactive</button>

                                            <?php
                                            }

                                            ?>
                                        </td>
                                    </tr>
                                <?php
                                }

                                ?>

                            </tbody>
                        </table>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Update Category Modal -->

        <!-- Update Brand Modal -->
        <div class="modal fade" id="updateBrandModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5">Update Brand</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body col-12">
                        <div class="mb-2">

                            <table class="table table-striped align-middle">
                                <thead>
                                    <tr>
                                        <th>Brand Name</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody class="table-group-divider">

                                    <?php
                                    $rs2 = Database::search("SELECT * FROM `brand`");
                                    $num2 = $rs2->num_rows;

                                    for ($x2 = 0; $x2 < $num2; $x2++) {
                                        $d2 = $rs2->fetch_assoc();
                                    ?>
                                        <tr>
                                            <td><?php echo $d2["brand_name"]; ?></td>
                                            <td><?php

                                                if ($d2["status"] == '1') {
                                                ?>

                                                    <button class="col-8 offset-2 btn btn-sm col btn-success fw-bold" onclick="changeBrandStatus(<?php echo ($d2['brand_id']); ?>);">Active</button>

                                                <?php
                                                } else {
                                                ?>

                                                    <button class="col-8 offset-2 btn btn-sm btn-danger fw-bold" onclick="changeBrandStatus(<?php echo ($d2['brand_id']); ?>);">Deactive</button>

                                                <?php
                                                }

                                                ?>
                                            </td>
                                        </tr>
                                    <?php
                                    }

                                    ?>

                                </tbody>
                            </table>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Update Brand Modal -->


        <script src="script.js"></script>
        <script src="bootstrap.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    </body>

    </html>



<?php

} else {
    header("Location: admin-signin.php");
}

?>