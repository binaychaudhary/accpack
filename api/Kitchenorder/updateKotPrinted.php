<?php
	//chama o arquivo de conexão com o bd
	include("../../includes/conectar.php");

	$id = $_REQUEST['id'];
	
	$qry="update kitchen_order set is_kot_printed ='1' where id='$id'";
	
	$conn->query($qry);

	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0
	));
?>