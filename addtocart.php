<?php

if (isset($_POST['name'])) {
	$name = $_POST['name'];
	echo "<script>console.log('".$name."');</script>";
	addtocart($name);
}

function addtocart($name){
	include('./phps/db_conn.php');

	//check already exist name
	$query = "SELECT * FROM product WHERE name LIKE '".$name."'";
	//echo "<script>console.log('".$query."');</script>";
	$result = $mysqli->query($query);
	$row=$result->fetch_array(MYSQLI_ASSOC);

	if($row>0){
		$name = $row["name"];
		$prod_price = $row["price"];

		//get same item in cart
		include('functions.php');

	    $found = 0;
		foreach($_SESSION['cart'] as list($id, $item, $qty, $price)){
			if($item == $name){
				$found += 1;//found same item
			}
		}
		
		if($found>0){
			//already in cart
			foreach($_SESSION['cart'] as list($id, $item, $qty, $price)){
				if($item == $name){
					$qty += 1;//increase price and quentity
					$prod_price += $price;//increase price and quentity
				}
			}
			header('Location: ./index.php');
		}else{
			//new scanned product
			//create new line
			$newdata =  array (
		      'name' => '$name',
		      'qty' => '1',
		      'price' => '$prod_price'
		    );
			array_push($_SESSION['cart'],$newdata);
			header('Location: ./index.php');
		}
	}else{
	  header('Location: ./index.php?error=[Error] barcode "'.$barcode.'" does not exist!');
	}
}

?>