<?php
	//chama o arquivo de conexão com o bd
	include("../../includes/conectar.php");
	$info = $_POST['units'];

	$data = json_decode($info);

	$Unit = $data->Unit;
	$ShortName = $data->ShortName;
	$status = $data->status;

	//consulta sql
	$query = sprintf("INSERT INTO unit (Unit, ShortName,Status) values ('%s','%s','%d')",
		$conn->real_escape_string($Unit),
		$conn->real_escape_string($ShortName),
		$conn->real_escape_string($status)
		);

	$rs = $conn->query($query);

	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		"units" => array(
			"id" => mysqli_insert_id($conn),
			"Unit" => $Unit,
			"ShortName" => $ShortName,
			"status" => $status
		)
	));
?>