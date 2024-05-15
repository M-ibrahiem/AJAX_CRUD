<?php 
include_once ('config/db.php');
$data = file_get_contents("php://input"); // get all data which requested to this page
$finalPhpData = json_decode($data, true);  //=>php asoc array 
$std_id = $finalPhpData['id']; 

$select = "SELECT * FROM std WHERE id = $std_id";
$select_q = mysqli_query($conn, $select);
$student_data = mysqli_fetch_assoc($select_q);
echo json_encode($student_data);