<?php
include('./phps/db_conn.php');

$name=$_GET['name'];

//check already exist name
$query = "SELECT * FROM category WHERE name='$name'";
$result = $mysqli->query($query);
$row=$result->fetch_array(MYSQLI_ASSOC);

if($row_count>0){
    echo "<script type=\"text/javascript\">alert('category $name already exist!');</script>";
}else{
    $sql = "INSERT INTO category (name) VALUES ('$name')";
    $result=$mysqli->query($sql);
    if($result){
    	echo "<script type=\"text/javascript\">alert('category successfully added!');</script>";
    	//header('Location: ./signIn.php?error= category successfully added!');
    }
}


if($row_count>0){
   			header('Location: ./Registration.php?error=username exist');
        //if username is valid
   		}else{
        //Insert registration detail in database
   			$sql = "INSERT INTO users (username, password, mobile, email, access, firstname, lastname, address, dateofbirth, qualification, expertise, availability) VALUES ('$username', '$password', '$phonenumber', '$email', '$access', '$fname', '$lname' ,'$address','$dateofbirth', '$qualification', '$expertise', 'available')";
   			$result=$mysqli->query($sql);
        //if register successful
   			if($result){
   				$session_user=$username;
   				$_SESSION['session_user']=$session_user;
   				header('Location: index.php');
          //do extra database work for staff registration
          $availability = "available";
          if($mode!="student"){
            $sql = "INSERT INTO staff (name, qualification, expertise, availability) VALUES ('$fname', '$qualification', '$expertise', '$availability')";
            $result=$mysqli->query($sql);
          }
   			}
   		}
?>