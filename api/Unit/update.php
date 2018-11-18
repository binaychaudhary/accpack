<?php
	//chama o arquivo de conexão com o bd
	include("../../includes/conectar.php");
	$info = $_POST['units'];

	$data = json_decode($info);
	$id = $data->id;
	$Unit = $data->Unit;
	$ShortName = $data->ShortName;
	$status = $data->status;
	

	
	//consulta sql
	$query = sprintf("UPDATE unit SET Unit = '%s', ShortName = '%s', status = '%d' WHERE id=%d",
		$conn->real_escape_string($Unit),
		$conn->real_escape_string($ShortName),
		$conn->real_escape_string($status),
		$conn->real_escape_string($id));

	$rs = $conn->query($query);

	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		"units" => array(
			"id" => $id,
			"Unit" => $Unit,
			"ShortName" => $ShortName,
			"status" => $status
		)
	));
?>