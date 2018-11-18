<?php
	//chama o arquivo de conexão com o bd
	include("../../includes/conectar.php");

	$info = $_POST['pipelinemeterstatus'];

	$data = json_decode($info);
	
	$status_name = $data->status_name;
	$status = $data->status;

		
	//consulta sql
	$query = sprintf("INSERT INTO pipeline_meter_status (status_name,status) values ('%s','%d')",
		$conn->real_escape_string($status_name),
		$conn->real_escape_string($status)
	);

	$rs = $conn->query($query);

	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		"pipelinemeterstatus" => array(
			"id" => mysqli_insert_id($conn),
			"status_name" => $status_name,
			"status" => $status
		)
	));
?>