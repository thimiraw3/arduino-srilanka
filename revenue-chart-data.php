<?php

include "connection.php";

$rs = Database::search("SELECT 
    `stock_view`.`cat_name` AS `cat_name`,	
    SUM(`invoice_items`.`qty` * `invoice_items`.`price`) AS `revenue`
FROM 
    `invoice_items`
JOIN 
    `stock_view` ON `stock_view`.`stock_id` = `invoice_items`.`stock_id`
GROUP BY 
    `stock_view`.`cat_name`
ORDER BY 
    `revenue` DESC
");

$sales = [];
$date = [];

if ($rs->num_rows > 0) {
    while ($row = $rs->fetch_assoc()) {
        
    $cat_name[] = $row["cat_name"];
    $revenue[] = $row["revenue"];

    }
}

$json = [];
$json["cat_name"] = $cat_name;
$json["revenue"] = $revenue;

// Output the revenue data as JSON
echo json_encode($json);
