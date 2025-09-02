<?php

include "connection.php";

$rs = Database::search("SELECT 
    DATE(date_time) as `date`,
    SUM(total) as `total_sales`
FROM 
    `invoice`
GROUP BY 
    DATE(date_time)
ORDER BY 
    DATE(date_time) ASC
");

$sales = [];
$date = [];

if ($rs->num_rows > 0) {
    while ($row = $rs->fetch_assoc()) {
        
    $sales[] = $row["total_sales"];
    $date[] = $row["date"];

    }
}

$json = [];
$json["date"] = $date;
$json["total_sales"] = $sales;

// Output the sales data as JSON
echo json_encode($json);
