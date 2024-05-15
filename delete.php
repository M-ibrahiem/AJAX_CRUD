<?php 
include_once ('config/db.php');
$data = file_get_contents("php://input"); // get all data which requested to this page
$finalPhpData = json_decode($data, true);  //=>php asoc array 
$std_id = $finalPhpData['id'];


$delete = "DELETE FROM std WHERE id = $std_id";
$delete_q = mysqli_query($conn, $delete);

echo "student is deleted";