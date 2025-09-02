<div class="row">

    <h2 class="mb-3">Customer Questions </h2>
    <?php

    include "connection.php";

    $page = 1;
    if (isset($_GET["page"]) && $_GET["page"] > 1) {
        $page = $_GET["page"];
    }

    $rs = Database::search("SELECT * FROM `customer_questions`");
    $num = $rs->num_rows;

    $resultsPerPage = 10;
    $noOfPages = ceil($num / $resultsPerPage);
    $pageResults = ($page - 1) * $resultsPerPage;

    $rs2 = Database::search("SELECT * FROM `customer_questions` ORDER BY `datetime` DESC LIMIT $resultsPerPage OFFSET $pageResults");
    $num2 = $rs2->num_rows;

    for ($x = 0; $x < $num2; $x++) {
        $row = $rs2->fetch_assoc();

    ?>

        <div class="card shadow rounded-3 mb-3">
            <div class="row">
                <div class="col-6">
                    <h2 class="text-danger mt-2 ms-2"><?php echo $row["email"]; ?></h2>
                </div>
                <div class="col-6 text-end">
                    <button onclick="removeFromMessage(<?php echo $row['id']; ?>);" class="btn btn-danger btn-sm mt-2"><i class="bi bi-trash3"></i></button>
                </div>

            </div>
            <div class="ms-4 my-2">
                <span>Name : <?php echo $row["f_name"] . " " . $row["l_name"]; ?></span><br>
                <span>Date Time : <?php echo $row["datetime"]; ?></span><br>
                <span>Message : <?php echo $row["message"]; ?></span><br>
            </div>
        </div>

    <?php
    }

    ?>

</div>


<nav class="mt-3">
    <ul class="pagination justify-content-center">

        <li class="page-item">
            <a class="page-link" aria-label="Previous" <?php if ($page > 1) { ?>onclick="loadQuestionProcess(<?php echo ($page - 1); ?>);" <?php } ?>>
                <span aria-hidden="true">&laquo;</span>
            </a>
        </li>
        <?php
        for ($i = 1; $i <= $noOfPages; $i++) {
            if ($i == $page) {
        ?>
                <li class="page-item active"><a class="page-link" onclick="loadQuestionProcess(<?php echo ($i); ?>);"><?php echo ($i); ?></a></li>
            <?php
            } else {
            ?>
                <li class="page-item"><a class="page-link" onclick="loadQuestionProcess(<?php echo ($i); ?>);"><?php echo ($i); ?></a></li>
        <?php
            }
        }
        ?>

        <li class="page-item">
            <a class="page-link" aria-label="Next" <?php if ($page < $noOfPages) { ?>onclick="loadQuestionProcess(<?php echo ($page + 1); ?>);" <?php } ?>>
                <span aria-hidden="true">&raquo;</span>
            </a>
        </li>
    </ul>
</nav>