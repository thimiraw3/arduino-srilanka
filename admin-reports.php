<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reports - Arduino Sri Lanka</title>
    <link rel="icon" href="resources/logo/logo.png" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body class="overflow-y-hidden">

    <?php include "admin-header.php" ?>

    <div class="container">
        <div class="row vh-100 d-flex align-items-center">
            <div class="col-12">
                <div class="row">
                    <div class="col-12 col-lg-4 mb-4">
                        <a class="btn btn-primary fw-bold w-100" href="user-report.php">User Report</a>
                    </div>

                    <div class="col-12 col-lg-4 mb-4">
                        <a class="btn btn-secondary fw-bold w-100" href="product-report.php">Products Report</a>
                    </div>

                    <div class="col-12 col-lg-4 mb-4">
                        <a class="btn btn-success fw-bold w-100" href="stock-report.php">Stock Report</a>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-lg-4 mb-4">
                        <a class="btn btn-warning fw-bold w-100" href="sellings-report.php">Sellings Report All Time</a>
                    </div>

                    <div class="col-12 col-lg-4 mb-4">
                        <a class="btn btn-warning fw-bold w-100" href="selling-report-this-week.php">Sellings Report This Week</a>
                    </div>

                    <div class="col-12 col-lg-4 mb-4">
                        <a class="btn btn-info fw-bold w-100" href="popular-product-report.php">Popular Products Report</a>
                    </div>

                </div>

            </div>

        </div>
    </div>


    <?php include "admin-footer.php" ?>

    <script src="script.js"></script>
</body>

</html>