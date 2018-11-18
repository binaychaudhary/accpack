<?php
	include_once('conectar.php');

	$tblName = $_REQUEST['tblName'];
	$id = $_REQUEST['id'];

	$sql ="delete from ".$tblName." where id ='".$id."'";
	
	$conn->query($sql);

	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		"response" => mysqli_connect_errno()
	));	

?>