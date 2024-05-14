<?php
include_once('config/db.php');

$select = "SELECT * FROM std";
$select = mysqli_query($conn, $select);
$count = mysqli_num_rows($select);

if ($count > 1) {
    $allData = [];
    while ($row =mysqli_fetch_assoc($select)) {
        $allData[] = $row;
    }
} else {
    $allData[] = mysqli_fetch_assoc($select);
}

echo json_encode($allData);