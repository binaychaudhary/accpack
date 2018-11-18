<?php
	//chama o arquivo de conexão com o bd
	include("../../includes/conectar.php");

	$info = $_POST['roles'];

	$data = json_decode($info);

	$role = $data->role;
	$status = $data->status;


	//consulta sql
	$query = sprintf("INSERT INTO role (role, status) values ('%s', '%d')",
		$conn->real_escape_string($role),
		$conn->real_escape_string($status)
		);

	$rs = $conn->query($query);

	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		"roles" => array(
			"id" => mysqli_insert_id($conn),
			"role" => $role,
			"status" => $status
		)
	));
?>