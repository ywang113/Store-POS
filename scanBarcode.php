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

	$contents="";
	$found = 0;
}else{
  header('Location: ./index.php?error=[Error] barcode "'.$barcode.'" does not exist!');
}
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
			selectedProductsArray.unshift(thisProduct)
		}
		myStorage.setItem('selectedProductArray', JSON.stringify(selectedProductsArray))
		// list items in cart view
		window.history.back(-1); 
	}

</script>

<?php 
	echo "<script type='text/javascript'>addItemToCart();</script>";
?>