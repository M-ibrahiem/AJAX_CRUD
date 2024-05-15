<?php
include_once('config/db.php');

$data = file_get_contents("php://input"); // get all data which requested to this page

$finalPhpData = json_decode($data, true);  //=>php asoc array 

// var_dump($finalPhpData);

$name = $finalPhpData['name'];
$email = $finalPhpData['email'];
$password = $finalPhpData['password'];
$id = intval($finalPhpData['id']);

// upsert

$stat = "INSERT INTO std (id, name, email, password)
         VALUES ($id, '$name', '$email', '$password')
         ON DUPLICATE KEY UPDATE name='$name', email='$email', password='$password'";

$insert_q = mysqli_query($conn, $stat);




if (!mysqli_error($conn)) {
    echo "Student is Successfully";
} else {
    mysqli_error($conn);
}
