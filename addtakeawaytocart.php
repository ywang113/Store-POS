<?php

if (isset($_POST['price'])) {
	$price = $_POST['price'];
	$name = $_POST['name'];	
	echo "<script>console.log(".$name."'takeaway added: ".$price."');</script>";
	addtakeawaytocart($name, $price);
	// echo "<script>alert('".$name."');</script>";
}

function addtakeawaytocart($name,$price){
	include('functions.php');
	$newdata = array("name"=>'$name',"qty"=>'1', "price"=>'$price');

	array_push($_SESSION['cart'],$newdata);
	echo "<script> console.log($_SESSION['cart']);</script>";
	header('Location: ./index.php');
}

?>