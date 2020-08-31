<?php
include('./phps/db_conn.php');

date_default_timezone_set('Australia/Hobart');
$date = date('d/m/Y H:i:s', time());
$total=$_POST['confirmgross_price'];
$paid =$_POST['confirmgivenamount'];
$change=$_POST['confirmchange'];
$method=$_POST['confirmmethod'];
$invoice=rand(12345678,99999999);

//save transaction
$sql = "ALTER TABLE transaction AUTO_INCREMENT = 1";
$mysqli->query($sql);
$sql = "INSERT INTO transaction (invoice,date,total,paid,change2,method) 
		VALUES ('$invoice','$date','$total','$paid','$change','$method')";
$mysqli->query($sql);


//save sold items
$query = "SELECT * FROM cart";
$sql = "ALTER TABLE sold AUTO_INCREMENT = 1";
$mysqli->query($sql);

if($result = $mysqli->query($query)){
    while ($row = $result->fetch_assoc()) {
        $item = $row["item"];
        $qty = $row["qty"];
        $price = $row["price"];

        $sql = "INSERT INTO sold (item,qty,price,date) 
        		VALUES ('$item','$qty','$price','$date')";
		$mysqli->query($sql);
    }
$result->free();
}


//empty cart
$query = "DELETE FROM cart";
$result = $mysqli->query($query);

if($result){
  header('Location: ./index.php');
}else{
  header('Location: ./index.php?error=Something wrong?');
}
$result->free();
?>