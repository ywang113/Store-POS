<?php
include('./phps/db_conn.php');

$sql=$_GET['sql'];
$mysqli->query($sql);
?>