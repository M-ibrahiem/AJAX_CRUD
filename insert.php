<?php
include_once ('config/db.php');

$data = file_get_contents("php://input"); // get all data which requested to this page

$finalPhpData = json_decode($data, true);  //=>php asoc array 

// var_dump($finalPhpData);

$name = $finalPhpData['name'];
$email = $finalPhpData['email'];
$password = $finalPhpData['password'];

$insert = "INSERT INTO `std`( `name`, `email`, `password`) VALUES ('$name','$email','$password')";
$insert_q = mysqli_query($conn,$insert);



if(!mysqli_error($conn)){
echo "Student is Successfully";
}else{
    mysqli_error($conn);
}
