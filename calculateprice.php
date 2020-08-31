<?php
include('./phps/db_conn.php');

//check already exist name
$query = "SELECT SUM(price) totalitems FROM cart";
$result = $mysqli->query($query);
$row=$result->fetch_array(MYSQLI_ASSOC);

if($row>0){
  echo round($row['totalitems'],2);
}else{
  echo 0;
}

?>