<?php
include 'connect.php';

$id = $_POST['id'];
$sql="DELETE FROM `cars` WHERE id = $id"; 
$result=mysqli_query($con,$sql);
?>