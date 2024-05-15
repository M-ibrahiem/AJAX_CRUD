<?php
include_once('config/db.php');

$select = "SELECT * FROM std";
$select_q = mysqli_query($conn, $select);
$count = mysqli_num_rows($select_q);

if ($count > 1) {
    $allData = [];
    while ($row =mysqli_fetch_assoc($select_q)) {
        $allData[] = $row;
    }
} else {
    $allData[] = mysqli_fetch_assoc($select_q);
}

echo json_encode($allData);