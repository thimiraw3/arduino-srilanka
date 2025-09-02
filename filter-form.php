<div class="col-12">
    <div class="card shadow rounded-3">
        <div class="card-body row">
            <h2><i class="bi bi-funnel-fill fs-2"></i> Filter Products</h2>
            <hr>

            <div class="mb-2 col-6">
                <label class="form-label fs-4" for="">Category</label>
                <select class="form-select" id="category">
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

            <div class="mb-2 col-6">
                <label class="form-label fs-4" for="">Brand</label>
                <select class="form-select" id="brand">
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

            <div class="mb-2 col-6">
                <label class="form-label" for="">Price From</label>
                <input class="form-control" type="text" id="priceFrom">
            </div>

            <div class="mb-2 col-6">
                <label class="form-label" for="">Price To</label>
                <input class="form-control" type="text" id="priceTo">
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
            <option value="0">none</option>
            <option value="1">Price Low to high</option>
            <option value="2">Price high to low</option>

        </select>
    </div>
</div>