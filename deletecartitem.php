<?php
	include('./phps/db_conn.php');
	function startsWith($string, $startString) 
	{ 
	    $len = strlen($startString); 
	    return (substr($string, 0, $len) === $startString); 
	} 

	$input = filter_input_array(INPUT_POST);
	echo json_encode($input);

	//$numb = mysqli_real_escape_string($mysqli, $input["numb"]);
	$item = mysqli_real_escape_string($mysqli, $input["item"]);	
	//$qty = mysqli_real_escape_string($mysqli, $input["qty"]);
	$price = mysqli_real_escape_string($mysqli, $input["price"]);	
	
	//echo "<script>console.log('".$price."');</script>";	
	//cut $ if exist
	 

	if($input["action"] === 'edit')
	{
	 $query = "
	 UPDATE cart 
	 SET 
	 price = '".$price."'
	 WHERE item = '".$item."'
	 ";

	 mysqli_query($mysqli, $query);
	}

	if($input["action"] === 'delete')
	{
	 $query = "
	 DELETE FROM cart 
	 WHERE item = '".$item."'
	 ";

	 mysqli_query($mysqli, $query);
	}
?> 