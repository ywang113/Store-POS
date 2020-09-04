<?php

function categorybutton(){
	include('./phps/db_conn.php');
	$query = "SELECT * FROM category";

	if($result = $mysqli->query($query)){
	    while ($row = $result->fetch_assoc()) {
	        $name = $row["name"];
	                 
	        echo '<button type="button" onclick="togglecategory(`'.$name.'`);" class="btn btn-outline-secondary btn-sm" data-btn-class="btn btn-warning">'.$name.'</button>';
	    }
	 $result->free();
	 }
}

function allMenu(){
	include('./phps/db_conn.php');
	$query = "SELECT * FROM category";

	if($result = $mysqli->query($query)){
	    while ($row = $result->fetch_assoc()) {
	        $name = $row["name"];
	        if($name != "Standard"){
	        	listMenu($name);
	    	}
	    }
	 $result->free();
	 }
 }

function listMenu($category){
	include('./phps/db_conn.php');
	$num = 2;

	$query = "SELECT * FROM product WHERE category='".$category."'";
	//echo "<script>console.log('".$query."');</script>";
	if($result = $mysqli->query($query)){
		echo '<table id="card-box" class="toggle'.$category.' togglecategory">';
		echo '<tr><th><hr>'.$category.'</th></tr>';
		echo '<tr>';
	    while ($row = $result->fetch_assoc()) {
	    	$name = $row["name"];
	        $price = $row["price"];
	        $picture = $row["picture"];
	        $rname = "'".$name."'";
	        if($num==7){
				echo '</tr>';
				echo '<tr>';				
				$num=1;
	        }

	        echo '<td>
                    <div class="box" value ='.$rname.'>
                        <img id="product_img2" src="./public/uploads/product_image/'.$picture.'">
                        <div class="container">
                            <h4 id="product_name"><b>'.$name.'</b></h4>
                            <p>$ '.$price.'</p>
                        </div>
                    </div>
                  </td>';

	        $num = $num +1 ;
    	}
    	$result->free();
    	echo '</tr>';
    	echo '</table>';
 	}
}

function optionCategory(){
	include('./phps/db_conn.php');
	$query = "SELECT * FROM category";

	if($result = $mysqli->query($query)){
	    while ($row = $result->fetch_assoc()) {
	        $name = $row["name"];
	                 
	        echo '<option>'.$name.'</option>';
	    }
	$result->free();
	}
}

function listProduct(){
	include('./phps/db_conn.php');
	$query = "SELECT * FROM product ORDER BY ID DESC";
	$numb="0";
	if($result = $mysqli->query($query)){
	    while ($numb < "20") {
	        $row = $result->fetch_assoc();
	        $name = $row["name"];
	        $category = $row["category"];
	        $price = $row["price"];
	        $stock = $row["stock"];
	        $barcode = $row["barcode"];
	                 
	        echo '<tr id="cordinator"> 
	            <td>'.$name.'</td>
	            <td>'.$category.'</td>
	            <td>$ '.$price.'</td>
	            <td>'.$stock.'</td>
	            <td>'.$barcode.'</td>
	            <td></td>
	            </tr>';
	        $numb++;
	    }
	$result->free();
	}
}

function listUser(){
	include('./phps/db_conn.php');
	$query = "SELECT * FROM user";

	if($result = $mysqli->query($query)){
	    while ($row = $result->fetch_assoc()) {
	        $name = $row["name"];
	        $username = $row["Username"];
	        $status = $row["status"];
	                 
	        echo '<tr id="cordinator"> 
	            <td>'.$name.'</td>
	            <td>'.$username.'</td>
	            <td>'.$status.'</td>
	            <td>action</td>
	            </tr>';
	    }
	$result->free();
	}
}

function listCategory(){
	include('./phps/db_conn.php');
	$query = "SELECT * FROM category";

	if($result = $mysqli->query($query)){
	    while ($row = $result->fetch_assoc()) {
	        $name = $row["name"];
	                 
	        echo '<tr id="cordinator"> 
	            <td>'.$name.'</td>
	            <td>link</td>
	            </tr>';
	    }
	$result->free();
	}
}

function printreceipt(){
	include('./phps/db_conn.php');

	echo "<h4 style='text-align: center;'>Snug Friendly</h4>
	    <h6>1 Beach Rd, Snug TAS 7054</h6>
		<h6>Tel. 03 6267 9332</h6>
		<hr>
		";
	$query = "SELECT * FROM transaction ORDER BY ID DESC";

	$result = $mysqli->query($query);
	$row = $result->fetch_assoc();

   	$invoice = $row["invoice"]; 
    $date = $row["date"];
    $total = $row["total"];
    $paid = $row["paid"];
    $change2 = $row["change2"];
    $method = $row["method"];
    $till = $row["till"];
	                 
    echo ' 
        <h6>invoice No.: '.$invoice.'</h6>
        <h6>date : '.$date.'</h6>
        <h6>till : '.$till.'</h6>
        <hr>
        <table>
        <th width="60%"><h6>item</h6></th>
        <th width="20%"><h6>Qty</h6></th>
        <th width="20%"><h6>price</h6></th>';
	    
	    //shopping contents
	    $query = "SELECT * FROM sold WHERE date LIKE '$date'";
	    $result = $mysqli->query($query);
	    while($row = $result->fetch_assoc()){

	        $item = $row["item"]; 
	        $qty = $row["qty"];
	        $price = $row["price"];
	                 
	        echo '<tr>
	            <td><h6>'.$item.'</h6></td>
	            <td><h6>'.$qty.'</h6></td>
	            <td><h6>$ '.$price.'</h6></td>
	            </tr>';
	    }
	
	echo '</table>
		<hr>
		<h5>total :	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$'.$total.'</h6>
        <h6>paid : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$'.$paid.'</h6>
        <h6>change : &nbsp;&nbsp;&nbsp;$'.$change2.'</h6>
        <h6>method : &nbsp;&nbsp;'.$method.'</h6>';
    $result->free();
}

//Transaction view
function listSold(){
	include('./phps/db_conn.php');
	date_default_timezone_set('Australia/Hobart');
	$now = date('d/m/Y');
	$yesterday = date('d/m/Y', strtotime( '-1 days' ));

	if(date('H:i:s')>date('17:00:00')){
		$tomorrow = date('d/m/Y', strtotime( '+1 days' ));
		$yesterday = $now;
		$now = $tomorrow;
	}

	$query = "SELECT * FROM sold WHERE (date BETWEEN '$now 00:00:00' AND '$now 17:00:00') OR (date BETWEEN '$yesterday 17:00:00' AND '$yesterday 19:00:00') ORDER BY ID DESC";
	
	if($result = $mysqli->query($query)){
	    while ($row = $result->fetch_assoc()) {
	        $name = $row["item"];
	        $qty = $row["qty"];
	        $price = $row["price"];
	        $sale = $qty * $price;
	                 
	        echo '<tr id="cordinator"> 
	            <td>'.$name.'</td>
	            <td>'.$qty.'</td>
	            <td>$ '.$price.'</td>
	            <td>$ '.$sale.'</td>
	            </tr>';
	    }
	 $result->free();
	 }
}

function showTotalSales(){
	include('./phps/db_conn.php');
	date_default_timezone_set('Australia/Hobart');
	$now = date('d/m/Y');
	$yesterday = date('d/m/Y', strtotime( '-1 days' ));

	if(date('H:i:s')>date('17:00:00')){
		$tomorrow = date('d/m/Y', strtotime( '+1 days' ));
		$yesterday = $now;
		$now = $tomorrow;
	}

	$query = "SELECT SUM(price) totalsold FROM sold WHERE (date BETWEEN '$now 00:00:00' AND '$now 17:00:00') OR (date BETWEEN '$yesterday 17:00:00' AND '$yesterday 19:00:00')";
	$result = $mysqli->query($query);
	$row=$result->fetch_array(MYSQLI_ASSOC);

	echo round($row['totalsold'],2);
	
	$result->free();
}

function showTotalTransaction(){
	include('./phps/db_conn.php');
	date_default_timezone_set('Australia/Hobart');
	$now = date('d/m/Y');
	$yesterday = date('d/m/Y', strtotime( '-1 days' ));
	
	if(date('H:i:s')>date('17:00:00')){
		$tomorrow = date('d/m/Y', strtotime( '+1 days' ));
		$yesterday = $now;
		$now = $tomorrow;
	}

	$query = "SELECT * FROM transaction WHERE (date BETWEEN '$now 00:00:00' AND '$now 17:00:00') OR (date BETWEEN '$yesterday 17:00:00' AND '$yesterday 19:00:00')";
	$result = $mysqli->query($query);
	echo mysqli_num_rows ( $result );

	$result->free();
}

function showTotalItems(){
	include('./phps/db_conn.php');
	date_default_timezone_set('Australia/Hobart');
	$now = date('d/m/Y');
	$yesterday = date('d/m/Y', strtotime( '-1 days' ));
	
	if(date('H:i:s')>date('17:00:00')){
		$tomorrow = date('d/m/Y', strtotime( '+1 days' ));
		$yesterday = $now;
		$now = $tomorrow;
	}

	$query = "SELECT SUM(qty) totalqty FROM sold WHERE (date BETWEEN '$now 00:00:00' AND '$now 17:00:00') OR (date BETWEEN '$yesterday 17:00:00' AND '$yesterday 19:00:00')";
	$result = $mysqli->query($query);
	$row=$result->fetch_array(MYSQLI_ASSOC);

	echo $row['totalqty'];
	
	$result->free();
}

function showTotalProducts(){
	include('./phps/db_conn.php');
	date_default_timezone_set('Australia/Hobart');
	$now = date('d/m/Y');
	$yesterday = date('d/m/Y', strtotime( '-1 days' ));
	
	if(date('H:i:s')>date('17:00:00')){
		$tomorrow = date('d/m/Y', strtotime( '+1 days' ));
		$yesterday = $now;
		$now = $tomorrow;
	}

	$query = "SELECT * FROM sold WHERE (date BETWEEN '$now 00:00:00' AND '$now 17:00:00') OR (date BETWEEN '$yesterday 17:00:00' AND '$yesterday 19:00:00') GROUP BY item";
	$result = $mysqli->query($query);
	echo mysqli_num_rows ( $result );

	$result->free();
}


function listTransaction(){
	include('./phps/db_conn.php');
	date_default_timezone_set('Australia/Hobart');
	$now = date('d/m/Y');
	$yesterday = date('d/m/Y', strtotime( '-1 days' ));
	
	if(date('H:i:s')>date('17:00:00')){
		$tomorrow = date('d/m/Y', strtotime( '+1 days' ));
		$yesterday = $now;
		$now = $tomorrow;
	}
	
	$query = "SELECT * FROM transaction WHERE (date BETWEEN '$now 00:00:00' AND '$now 17:00:00') OR (date BETWEEN '$yesterday 17:00:00' AND '$yesterday 19:00:00') ORDER BY ID DESC";

	if($result = $mysqli->query($query)){
	    while ($row = $result->fetch_assoc()) {
	    	$ID = $row["ID"];
	        $invoice = $row["invoice"];
	        $date = $row["date"];
	        $total = $row["total"];
	        $paid = $row["paid"];
	        $change2 = $row["change2"];
	        $method = $row["method"];
	        $till = $row["till"];                
	                 
	        echo '<tr id="cordinator"> 
	            <td>'.$invoice.'</td>
	            <td>'.$date.'</td>
	            <td>$ '.$total.'</td>
	            <td>$ '.$paid.'</td>
	            <td>$ '.$change2.'</td>
	            <td>'.$method.'</td>
	            <td>'.$till.'</td>
	            <td><button class="btn btn-info waves-effect waves-light past_receipt" value="'.$date.'">
                        <i class="fa fa-print"></i> 
                    </button>
                    </td>
	            </tr>';
	    }
	$result->free();
	}

}

function optionCustomer(){
	include('./phps/db_conn.php');

	$query = "SELECT * FROM customer";

	if($result = $mysqli->query($query)){
	    while ($row = $result->fetch_assoc()) {
	        $name = $row["name"];
	                 
	        echo '<option>'.$name.'</option>';
	    }
	$result->free();
	}
}





?>