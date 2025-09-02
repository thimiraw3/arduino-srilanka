<table class="table table-striped align-middle">
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Category</th>
            <th>Brand</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody class="table-group-divider">

        <?php

        include "connection.php";

        $page = 1;
        if (isset($_GET["page"]) && $_GET["page"] > 1) {
            $page = $_GET["page"];
        }

        $search = "";

        if (isset($_GET["searchTxt"])) {
            $search = $_GET["searchTxt"];
        }

        $rs = Database::search("SELECT * FROM `product_details` WHERE `name` LIKE '%$search%' 
                                OR `cat_name` LIKE '%$search%'
                                OR `brand_name` LIKE '%$search%'");
        $num = $rs->num_rows;

        $resultsPerPage = 6;
        $noOfPages = ceil($num / $resultsPerPage);
        $pageResults = ($page - 1) * $resultsPerPage;

        $rs2 = Database::search("SELECT * FROM `product_details` WHERE `name` LIKE '%$search%' 
                                OR `cat_name` LIKE '%$search%'
                                OR `brand_name` LIKE '%$search%' LIMIT $resultsPerPage OFFSET $pageResults");
        $num2 = $rs2->num_rows;

        for ($x = 0; $x < $num2; $x++) {
            $row = $rs2->fetch_assoc();


        ?>

            <tr>
                <td><?php echo $row["id"]; ?></td>
                <td><?php echo $row["name"]; ?></td>
                <td><?php echo $row["cat_name"]; ?></td>
                <td><?php echo $row["brand_name"]; ?></td>
                <td>
                    <?php

                    if ($row["status"] == '1') {
                    ?>

                        <button class="btn btn-sm btn-success fw-bold" onclick="changeProductStatus(<?php echo ($row['id']); ?>);">Active</button>

                    <?php
                    } else {
                    ?>

                        <button class="btn btn-sm btn-danger fw-bold" onclick="changeProductStatus(<?php echo ($row['id']); ?>);">Deactive</button> 

                    <?php
                    }

                    ?>
                </td>
                <td>
                <button class="btn btn-sm btn-dark fw-bold" onclick="loadProdUpdateData(<?php echo($row['id']); ?>);">EDIT</button>
                </td>
            </tr>

        <?php
        }

        ?>


    </tbody>
</table>

<nav class="mt-3">
    <ul class="pagination justify-content-center">

        <li class="page-item">
            <a class="page-link" aria-label="Previous" <?php if ($page > 1) { ?>onclick="loadProducts(<?php echo ($page - 1); ?>);" <?php } ?>>
                <span aria-hidden="true">&laquo;</span>
            </a>
        </li>
        <?php
        for ($i = 1; $i <= $noOfPages; $i++) {
            if ($i == $page) {
        ?>
                <li class="page-item active"><a class="page-link" onclick="loadProducts(<?php echo ($i); ?>);"><?php echo ($i); ?></a></li>
            <?php
            } else {
            ?>
                <li class="page-item"><a class="page-link" onclick="loadProducts(<?php echo ($i); ?>);"><?php echo ($i); ?></a></li>
        <?php
            }
        }
        ?>

        <li class="page-item">
            <a class="page-link" aria-label="Next" <?php if ($page < $noOfPages) { ?>onclick="loadProducts(<?php echo ($page + 1); ?>);" <?php } ?>>
                <span aria-hidden="true">&raquo;</span>
            </a>
        </li>
    </ul>
</nav>