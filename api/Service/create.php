<?php
	//chama o arquivo de conexão com o bd
	include("../../includes/conectar.php");

	$info = $_POST['services'];

	$data = json_decode($info);
	
	$sdescription = $data->sdescription;
	$status=$data->status;

	//consulta sql
	$query = sprintf("INSERT INTO service (sdescription,status) values ('%s','%d')",
		$conn->real_escape_string($sdescription),
		$conn->real_escape_string($status)
	);

	$rs = $conn->query($query);

	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		"services" => array(
			"id" => mysqli_insert_id($conn),
			"sdescription" => $sdescription,
			"status"=>$status
		)
	));
?>