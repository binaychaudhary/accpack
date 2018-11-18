<?php
	//chama o arquivo de conexão com o bd
	include("conectar.php");
	$queryString = $_REQUEST['queryString'];
	//consulta sql
	$query = $conn->query($queryString) or die(mysqli_connect_error());

	
	//encoda para formato JSON
	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0
	));
?>