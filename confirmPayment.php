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
//$sql = "ALTER TABLE transaction AUTO_INCREMENT = 1";
//$mysqli->query($sql);
$sql = "INSERT INTO transaction (invoice,date,total,paid,change2,method) 
		VALUES ('$invoice','$date','$total','$paid','$change','$method')";
$mysqli->query($sql);
?>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script type="text/javascript"> 
  let myStorage = localStorage
  let existingProducts =  JSON.parse(myStorage.getItem('selectedProductArray'))
  let sql = "INSERT INTO sold (item,qty,price,date) VALUES "
  for(let i = 0; i < existingProducts.length ; i++){
    if(i == existingProducts.length-1){//last list
      sql = sql+"('"+existingProducts[i].name+"','"+existingProducts[i].qty+"','"+existingProducts[i].price*existingProducts[i].qty+"','"+"<?php echo $date ?>"+"');"
    }else{
      sql = sql+"('"+existingProducts[i].name+"','"+existingProducts[i].qty+"','"+existingProducts[i].price*existingProducts[i].qty+"','"+"<?php echo $date ?>"+"'),"
    }
  }
  
  function clearCart(){
    myStorage.removeItem('selectedProductArray')
  }

  $.ajax({
    type: "GET",
    url: "addsold.php",
    data: { sql: sql }
  }).done(function( msg ) {
    clearCart();
    window.location = './index.php';
  });

</script>