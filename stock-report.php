<?php
include "connection.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stock Report - Arduino Sri-Lanka</title>
    <link rel="icon" href="resources/logo/logo.png" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>

    <div class="container"> 
        <div class="row mb-5">
            <div class="col-12 mt-5 d-flex justify-content-center gap-3">
                <button class="btn btn-dark" onclick="history.back();"><i class="bi bi-arrow-left"></i> BACK</button>
                <button class="btn btn-danger" onclick="printReport();"><i class="bi bi-printer-fill"></i> PRINT</button>
            </div>
        </div>
    </div>

    <div class="container" id="printArea">
        <div class="row">
            <div class="col-12 text-center mb-3">
                <h1>Stock Report</h1>
            </div>

            <div class="col-12">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Stock Id</th>
                            <th>Product Name</th>
                            <th>Category</th>
                            <th>Brand</th>
                            <th>Qty</th>
                            <th>Unit Price</th>
                            <th>Warenty</th>
                            <th>Discount</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        <?php
                        $rs = Database::search("SELECT * FROM `stock_view`");
                        $num = $rs->num_rows;

                        for ($x = 0; $x < $num; $x++) {
                            $row = $rs->fetch_assoc();
                        ?>

                            <tr>
                                <td><?php echo ($row["stock_id"]); ?></td>
                                <td><?php echo ($row["name"]); ?></td>
                                <td><?php echo ($row["cat_name"]); ?></td>
                                <td><?php echo ($row["brand_name"]); ?></td>
                                <td><?php echo ($row["qty"]); ?></td>
                                <td><?php echo ($row["price"]); ?></td>
                                <td><?php echo ($row["warenty"]); ?></td>
                                <td><?php echo ($row["discount"]); ?></td>
                                <td>
                                    <?php
                                    if ($row["status"] == "1") {
                                        echo("Active");
                                    } else {
                                        echo("Deactive");
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
        </div>
    </div>

    <script src="script.js"></script>
</body>

</html>