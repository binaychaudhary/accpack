<?php
	//chama o arquivo de conexão com o bd
	include_once("../../includes/conectar.php");

	$info = $_POST['roles'];

	$data = json_decode($info);

	$status = $data->status;
	$role = $data->role;
	$id = $data->id;

	//consulta sql
	$query = sprintf("UPDATE role SET status = '%d', role = '%s' WHERE id=%d",
		$conn->real_escape_string($status),
		$conn->real_escape_string($role),
		$conn->real_escape_string($id));

	$rs = $conn->query($query);

	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		"roles" => array(
			"id" => $id,
			"role" => $role,
			"status" => $rtatus
		)
	));
?>