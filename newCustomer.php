<?php
include('./phps/db_conn.php');

$name=$_GET['name'];
$phone=$_GET['phone'];
$email=$_GET['email'];
$address=$_GET['address'];

//check already exist name
$query = "SELECT * FROM customer WHERE name='$name'";
$result = $mysqli->query($query);
$row=$result->fetch_array(MYSQLI_ASSOC);

if($row>0){
  header('Location: ./index.php?error=[Error] customer "'.$name.'" already exist!');
}else{
    $sql = "INSERT INTO customer (name,phone,email,address) VALUES ('$name','$phone','$email','$address')";
    $result=$mysqli->query($sql);
    if($result){
    	header('Location: ./index.php?error=customer successfully added!');
    }
}

?>