<table class="table table-striped align-middle">
    <thead>
        <tr>
            <th>#</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Mobile</th>
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

        $rs = Database::search("SELECT * FROM `user` WHERE `user_type_id`='2' AND (`fname` LIKE '%$search%' 
                                OR `lname` LIKE '%$search%'
                                OR `email` LIKE '%$search%'
                                OR `mobile` LIKE '%$search%')");
        $num = $rs->num_rows;

        $resultsPerPage = 5;
        $noOfPages = ceil($num / $resultsPerPage);
        $pageResults = ($page - 1) * $resultsPerPage;

        $rs2 = Database::search("SELECT * FROM `user` WHERE `user_type_id`='2' AND (`fname` LIKE '%$search%' 
                                OR `lname` LIKE '%$search%'
                                OR `email` LIKE '%$search%'
                                OR `mobile` LIKE '%$search%') LIMIT $resultsPerPage OFFSET $pageResults");
        $num2 = $rs2->num_rows;

        for ($x = 0; $x < $num2; $x++) {
            $row = $rs2->fetch_assoc();

        ?>

            <tr>
                <td><?php echo $row["id"]; ?></td>
                <td><?php echo $row["fname"]; ?></td>
                <td><?php echo $row["lname"]; ?></td>
                <td><?php echo $row["email"]; ?></td>
                <td><?php echo $row["mobile"]; ?></td>
                <td>
                    <?php

                    if ($row["status"] == '1') {
                    ?>

                        <button class="btn btn-sm btn-success w-100" onclick="changeUserStatus(<?php echo ($row['id']); ?>, 0);">Active</button>

                    <?php
                    } else {
                    ?>

                        <button class="btn btn-sm btn-danger w-100" onclick="changeUserStatus(<?php echo ($row['id']); ?>, 1);">Deactive</button>

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

<nav class="mt-3">
    <ul class="pagination justify-content-center">

        <li class="page-item">
            <a class="page-link" aria-label="Previous" <?php if ($page > 1) { ?>onclick="loadUsers(<?php echo ($page - 1); ?>);" <?php } ?>>
                <span aria-hidden="true">&laquo;</span>
            </a>
        </li>
        <?php
        for ($i = 1; $i <= $noOfPages; $i++) {
            if ($i == $page) {
        ?>
                <li class="page-item active"><a class="page-link" onclick="loadUsers(<?php echo ($i); ?>);"><?php echo ($i); ?></a></li>
            <?php
            } else {
            ?>
                <li class="page-item"><a class="page-link" onclick="loadUsers(<?php echo ($i); ?>);"><?php echo ($i); ?></a></li>
        <?php
            }
        }
        ?>

        <li class="page-item">
            <a class="page-link" aria-label="Next" <?php if ($page < $noOfPages) { ?>onclick="loadUsers(<?php echo ($page + 1); ?>);" <?php } ?>>
                <span aria-hidden="true">&raquo;</span>
            </a>
        </li>
    </ul>
</nav>