<?php

include "connection.php";

$rs = Database::search("SELECT 
    `stock_view`.`name` AS `product_name`,
    SUM(`invoice_items`.`qty`) AS `total_quantity`
FROM 
    `invoice_items`
JOIN 
    `stock_view` ON `invoice_items`.`stock_id` = `stock_view`.`stock_id`
GROUP BY 
    `stock_view`.`name`
ORDER BY 
    `total_quantity` DESC
LIMIT 10
");

$product = [];
$qty = [];

if ($rs->num_rows > 0) {
    while ($row = $rs->fetch_assoc()) {

        $product[] = $row["product_name"];
        $qty[] = $row["total_quantity"];
    }
}

$json = [];
$json["product"] = $product;
$json["qty"] = $qty;

// Output the sales data as JSON
echo json_encode($json);
