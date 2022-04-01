<?php
include 'connect.php';

$naziv = $_POST['naziv'];
$marka = $_POST['marka'];
$boja = $_POST['boja'];

$sql="INSERT INTO `cars`(`name`, `mark`, `color`) VALUES ('$naziv', '$marka', '$boja')";
$result=mysqli_query($con,$sql);
?>