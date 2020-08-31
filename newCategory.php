<?php
include('./phps/db_conn.php');

$name=$_GET['name'];

//check already exist name
$query = "SELECT * FROM category WHERE name='$name'";
$result = $mysqli->query($query);
$row=$result->fetch_array(MYSQLI_ASSOC);

if($row>0){
  header('Location: ./index.php?error=[Error] category "'.$name.'" already exist!');
}else{
    $sql = "INSERT INTO category (name) VALUES ('$name')";
    $result=$mysqli->query($sql);
    if($result){
    	header('Location: ./index.php?error=category successfully added!');
    }
}

?>