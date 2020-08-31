<?php
	include('./phps/db_conn.php');
	include('functions.php');
    
	echo "<h4 style='text-align: center;'>Settlement</h4>
    <h6>1 Beach Rd, Snug TAS 7054</h6>
    <h6>Tel. 03 6267 9332</h6>
    <hr>";


    date_default_timezone_set('Australia/Hobart');
    $now = date('d/m/Y');
    $yesterday = date('d/m/Y', strtotime( '-1 days' ));

    //get transactions
    $query = "SELECT * FROM transaction WHERE (date BETWEEN '$now 00:00:00' AND '$now 17:00:00') OR (date BETWEEN '$yesterday 17:00:00' AND '$yesterday 19:00:00')";
    $result = $mysqli->query($query);

    $transactions = mysqli_num_rows ( $result );

    //get items
    $query = "SELECT SUM(qty) totalqty FROM sold WHERE (date BETWEEN '$now 00:00:00' AND '$now 17:00:00') OR (date BETWEEN '$yesterday 17:00:00' AND '$yesterday 19:00:00')";
    $result = $mysqli->query($query);
    $row=$result->fetch_array(MYSQLI_ASSOC);
    
    $items = $row['totalqty'];

    //get gross
    $query = "SELECT SUM(price) totalsold FROM sold WHERE (date BETWEEN '$now 00:00:00' AND '$now 17:00:00') OR (date BETWEEN '$yesterday 17:00:00' AND '$yesterday 19:00:00')";
    $result = $mysqli->query($query);
    $row=$result->fetch_array(MYSQLI_ASSOC);
    
    //elements
    $gross = (float)$row['totalsold'];
    $gross = round($gross,2);

    $net = round($gross/0.05)*0.05;
    
    $round= $gross - $net;
    $round = round($round,2);

    //get total no GST
    $query = "SELECT SUM(price) totalnogst FROM
    (SELECT sd.ID, sd.item, sd.qty, sd.price, sd.date, pd.disable FROM sold AS sd 
    JOIN product AS pd 
    ON sd.item = pd.name) AS ts
    WHERE ts.disable=0 AND ((ts.date BETWEEN '$now 00:00:00' AND '$now 17:00:00') OR (ts.date BETWEEN '$yesterday 17:00:00' AND '$yesterday 19:00:00'));";
    $result = $mysqli->query($query);
    $row=$result->fetch_array(MYSQLI_ASSOC);

    $noGST_Product = round($row['totalnogst'],2);
    $taxableAMT = $gross - $noGST_Product;
    $taxableAMT = round($taxableAMT,2);
    $GST_included = round($taxableAMT/0.5)*0.05;

    //get cashout
    $query = "SELECT SUM(price) totalcashout FROM
    (SELECT sd.ID, sd.item, sd.qty, sd.price, sd.date, pd.category FROM sold AS sd 
    JOIN product AS pd 
    ON sd.item = pd.name) AS ts
    WHERE ts.category='Cash out' AND ((ts.date BETWEEN '$now 00:00:00' AND '$now 17:00:00') OR (ts.date BETWEEN '$yesterday 17:00:00' AND '$yesterday 19:00:00'));";
    $result = $mysqli->query($query);
    $row=$result->fetch_array(MYSQLI_ASSOC);

    $cashout = number_format($row['totalcashout'],2);

    echo '<h6>date : &nbsp;'.$now.'</h6>
        </table>
        <h6> transactions : '.$transactions.'times</h6>
        <h6> items : '.$items.' ea </h6>
        <hr>
        <h5>Gross : $ '.$gross.'</h5>
        <h5>Net :  $'.$net.'</h5>
        <hr>
        <h6>Round :  $'.$round.'</h6>
        <h6>Taxable AMT :  $'.$taxableAMT.'</h6>
        <h6>GST included : $ '.$GST_included.'</h6>
        <h6>GST Free :  $'.$noGST_Product.'</h6>
        <hr>
        <h6>cashout :  $'.$cashout.'</h6>
        ';


    //echo "<script> document.getElementById('viewTransaction').innerHTML = `".$echo."`; </script>";

?>