<?php
include 'connect.php';

$id = $_POST['id'];
$newColor = $_POST['newColor'];

$sql= "UPDATE `cars` SET color='{$newColor}' WHERE id =$id";
$result=mysqli_query($con,$sql);
?>