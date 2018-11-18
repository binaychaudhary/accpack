<?php
	//chama o arquivo de conexão com o bd
	include("../../../includes/conectar.php");

	$info = $_POST['rights'];

	$data = json_decode($info);

	$roleId = $data->roleId;
	$rightId=$data->rightId;
	$status=$data->status;


	//consulta sql
	$query = sprintf("INSERT INTO rightsassigned (roleId,rightId, status) values ('%d', '%d', '%d')",
		$conn->real_escape_string($roleId),
		$conn->real_escape_string($rightId),
		$conn->real_escape_string($status)
		);

	$rs = $conn->query($query);

	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		"rights" => array(
			"id" => mysqli_insert_id($conn),
			"roleId" => $roleId,
			"rightId" => $rightId,
			"status" => $status
		)
	));
?>