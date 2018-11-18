<?php
	//chama o arquivo de conexão com o bd
	include_once("../../includes/conectar.php");
	$info = $_POST['accategorys'];

	$data = json_decode($info);
	$id=$data->id;
	$acCategory = $data->acCategory;
	$status=$data->status;
	
	
	//consulta sql
	$query = sprintf("UPDATE accategory SET acCategory = '%s', status='%d' WHERE id=%d",
		$conn->real_escape_string($acCategory),
		$conn->real_escape_string($status),
		$conn->real_escape_string($id)
	);

	$rs = $conn->query($query);

	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		"accategorys" => array(
			"id" => $id,
			"acCategory" => $acCategory,
			"status" => $status
		)
	));
?>