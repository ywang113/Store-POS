<?php
include('./phps/db_conn.php');

$name=$_GET['name'];
$category = $_GET['category'];
$barcode =$_GET['barcode'];
$price=$_GET['price'];
$stock=$_GET['quantity'];
$disable=$_GET['stock'];
$imagename = $_GET['imagename'];
//$imagename = "./public/uploads/product_image/"+$imagename;
//check already exist name
$query = "SELECT * FROM product WHERE name='$name'";
$result = $mysqli->query($query);
$row=$result->fetch_array(MYSQLI_ASSOC);

if($row>0){
  header('Location: ./index.php?error=[Error] product "'.$name.'" already exist!');
}else{
    $sql = "INSERT INTO product (name,category,barcode,price,stock,disable,picture) VALUES ('$name','$category','$barcode','$price','$stock','$disable','$imagename')";
    $result=$mysqli->query($sql);
    if($result){
    	header('Location: ./index.php?error=product successfully added!');
    }
}

?>