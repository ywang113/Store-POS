<?php
	include('./phps/db_conn.php');
	$input = filter_input_array(INPUT_POST);
	echo json_encode($input);

	$invoice = mysqli_real_escape_string($mysqli, $input["invoice"]);
	
	if($input["action"] === 'delete')
	{
	 $query = "
	 SELECT date FROM transaction 
	 WHERE invoice = '".$invoice."'
	 ";

	 $result=$mysqli->query($query);
	 $row = $result->fetch_assoc();
	 $date = $row["date"];

	 # $date = mysqli_query($mysqli, $query);
	 
	 $query = "
	 DELETE FROM transaction 
	 WHERE invoice = '".$invoice."'
	 ";

	 mysqli_query($mysqli, $query);

	 $query = "
	 DELETE FROM sold 
	 WHERE date LIKE '%".$date."%'
	 ";

	 mysqli_query($mysqli, $query);	 
	}
?> 