<?php
include('./phps/db_conn.php');

$barcode=$_POST['skuCode'];

//check already exist name
$query = "SELECT * FROM product WHERE barcode LIKE '%$barcode%' OR name LIKE '%$barcode%'";
$result = $mysqli->query($query);
$row=$result->fetch_array(MYSQLI_ASSOC);

if($row>0){
	$name = $row["name"];
	$prod_price = $row["price"];

	//get same item in cart
	include('functions.php');
	$contents="";
	$found = 0;

	foreach($_SESSION['item'] as $i){
		$contents= $contents."-".$i;
		if($_SESSION['item'][$i] == $name){
			$found += 1;//found same item
		}
	}
		
	if($found>0){
		//already in cart
		foreach($_SESSION['item'] as $i){
			if($_SESSION['item'][$i] == $name){
				$_SESSION['qty'][$i] += 1;//increase price and quentity
				$_SESSION['price'][$i] += $prod_price;//increase price and quentity
			}
		}
		header('Location: ./index.php?error=aa');
	}else{
		//new scanned product
		//create new line
		array_push($_SESSION['item'],$name);
		array_push($_SESSION['qty'],"1");
		array_push($_SESSION['price'],$prod_price);

		header('Location: ./index.php?error='.$contents.' and '.$_SESSION['item'][0].'');
	}
}else{
  header('Location: ./index.php?error=[Error] barcode "'.$barcode.'" does not exist!');
}

?>