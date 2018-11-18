<?php
	//chama o arquivo de conexão com o bd
	include_once("../../includes/conectar.php");
	$info = $_POST['pipelinemeterstatus'];

	$data = json_decode($info);
	$id=$data->id;
	$status_name = $data->status_name;
	$status=$data->status;
	
	
	//consulta sql
	$query = sprintf("UPDATE pipeline_meter_status SET status_name = '%s', status = '%d' WHERE id=%d",
		$conn->real_escape_string($status_name),
		$conn->real_escape_string($status),
		$conn->real_escape_string($id)
	);

	$rs = $conn->query($query);

	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		"pipelinemeterstatus" => array(
			"id" => $id,
			"status_name" => $status_name,
			"status" => $status
		)
	));
?>