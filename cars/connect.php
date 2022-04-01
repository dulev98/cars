<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "buslogic";

$con = new mysqli('localhost', 'root', '', 'buslogic');

if(!$con){
    die(mysqli_error($con));
}





?>