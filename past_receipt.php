<?php

if (isset($_POST['date'])) {
	$date = $_POST['date'];
	print_past_receipt($date);
}

//echo "<script>alert('".$name."');</script>";

function print_past_receipt($date){
	include('./phps/db_conn.php');
	
	$echo = "<h4 style='text-align: center;'>Snug Friendly</h4>
    <h6>1 Beach Rd, Snug TAS 7054</h6>
    <h6>Tel. 03 6267 9332</h6>
    <hr>";

	$query = "SELECT * FROM transaction WHERE date LIKE '".$date."'";
	
	$result = $mysqli->query($query);
	$row = $result->fetch_assoc();

   	$invoice = $row["invoice"]; 
    $date = $row["date"];
    $total = $row["total"];
    $paid = $row["paid"];
    $change2 = $row["change2"];
    $method = $row["method"];
    $till = $row["till"];
	                 
    $echo = $echo.' 
        <h6>invoice No.: &nbsp;'.$invoice.'</h6>
        <h6>date : &nbsp;'.$date.'</h6>
        <h6>till : &nbsp;'.$till.'</h6>
        <hr>
        <table>
        <th width="60%"><h6>item</h6></th>
        <th width="20%"><h6>Qty</h6></th>
        <th width="20%"><h6>price</h6></th>';
	    
	    //shopping contents
	    $query = "SELECT * FROM sold WHERE date LIKE '".$date."'";
	    $result = $mysqli->query($query);
	    while($row = $result->fetch_assoc()){

	        $item = $row["item"]; 
	        $qty = $row["qty"];
	        $price = $row["price"];
	                 
	        $echo = $echo.'<tr>
                <td><h6>'.$item.'</h6></td>
                <td><h6>'.$qty.'</h6></td>
                <td><h6>$ '.$price.'</h6></td>
                </tr>';
	    }
	
	$echo = $echo.'</table>
        <hr>
        <h5>total :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$'.$total.'</h6>
        <h6>paid : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; $'.$paid.'</h6>
        <h6>change : &nbsp;&nbsp;&nbsp; $'.$change2.'</h6>
        <h6>method : &nbsp;&nbsp; '.$method.'</h6>';

    echo $echo;
    //echo "<script> document.getElementById('viewTransaction').innerHTML = `".$echo."`; </script>";

    $result->free();
}

?>