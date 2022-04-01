<?php 

include 'connect.php';
if(isset($_GET['colorId'])){

    $colorId = $_GET['colorId'];
    

}else{

    $colorId = "";

}
$sql = "SELECT * FROM `cars` WHERE color='{$colorId}'";
$result = mysqli_query($con, $sql);
while($row = mysqli_fetch_assoc($result)){
    echo '
        <tr>
            <td> '.$row['id'].' </td>
            <td>' .$row['name'].' </td>
            <td>' .$row['mark']. '</td>
            <td>' .$row['color']. ' </td>
            <td style="text-align: center;"> 
                <a id="crvena" onclick="promeniBoju('.$row['id'].',\'crvena\')" value="Update" class="waves-effect waves-light btn red " >CRVENA</a>
                <a id="zelena" onclick="promeniBoju('.$row['id'].',\'zelena\')" value="Update" class="waves-effect waves-light btn  green" >ZELENA</a>
                <a id="plava" onclick="promeniBoju('.$row['id'].',\'plava\')" value="Update" class="waves-effect waves-light btn  blue" >PLAVA</a> 
            </td>
            <td>
            <a onclick="deleteCar('.$row['id'].')" class="btn-large waves-effect waves-light red"><i class="material-icons">delete</i></a>
            </td>
        </tr>
        
        ';
    };

    





?>