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
?>

<script type="text/javascript"> 
	let myStorage = localStorage
	let existingProducts =  JSON.parse(myStorage.getItem('selectedProductArray'))
	let itemQty = 1
	let itemName="<?php echo $name;?>"
	let itemPrice = Math.floor(Number("<?php echo $prod_price?>") * 100 ) / 100
	// check if item is already in the cart
	if(existingProducts != null){
    var selectedProductsArray = existingProducts
	}
	else{
		var selectedProductsArray = []
	}
	function isItemSelected(){
		if(existingProducts != null){
			for(let i = 0; i < existingProducts.length ; i++){
				if(itemName === existingProducts[i].name){
					itemQty = existingProducts[i].qty + 1
					return i
				}
				else{
					
				}
			}
			return false
		}
		
		else{
			return false
		}
	}
	function addItemToCart(){
		let index = isItemSelected()
		let thisProduct = {
			'name' : itemName,
			'price' : itemPrice,
			'qty' : itemQty,
			'subTotal' : itemPrice * itemQty,
		}
		if(index !== false){
			// change the item which index point to
			selectedProductsArray[index] = {
				'name' : itemName,
				'price' : itemPrice,
				'qty' : itemQty,
				'subTotal' : itemPrice * itemQty,
			}
		}
		else{
			// push new item into itemArray
			selectedProductsArray.push(thisProduct)
		}
		myStorage.setItem('selectedProductArray', JSON.stringify(selectedProductsArray))
		// list items in cart view
		window.history.back(-1); 
	}

</script>
<?php		
	foreach($_SESSION['item'] as $i){
		$contents= $contents."-".$i;
		if($_SESSION['item'][$i] == $name){
			$found += 1;//found same item
		}
	}
	if($found>0){
		//already in cart 
		// ** DOESN'T WORK YET  **
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
		//Modified by Gary 
		//set scanned item to local storage
		echo "<script type='text/javascript'>addItemToCart();</script>";
		#header('Location: ./index.php?');
	}
}else{
  header('Location: ./index.php?error=[Error] barcode "'.$barcode.'" does not exist!');
}
?> 
