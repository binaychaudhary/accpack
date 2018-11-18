<?php
	//chama o arquivo de conexão com o bd
	include_once("../../../includes/conectar.php");

	$info = $_POST['rights'];

	$data = json_decode($info);

	$status = $data->status;
	$roleId = $data->roleId;
	$rightId=$data->rightId;
	$id = $data->id;

	//consulta sql
	$query = sprintf("UPDATE rightsassigned SET status = '%d', rightId = '%d' WHERE id=%d",
		$conn->real_escape_string($status),
		$conn->real_escape_string($rightId),
		$conn->real_escape_string($id));

	$rs = $conn->query($query);

	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		"rights" => array(
			"id" => $id,
			"roleId" => $roleId,
			"rightId"=>$rightId,
			"status" => $rtatus
		)
	));
?>