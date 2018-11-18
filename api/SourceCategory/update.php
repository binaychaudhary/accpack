<?php
	//chama o arquivo de conexão com o bd
	include_once("../../includes/conectar.php");
	$info = $_POST['sourcecategorys'];

	$data = json_decode($info);
	$id=$data->id;
	$status = $data->status;
	$category=$data->category;
	
	
	//consulta sql
	$query = sprintf("UPDATE sourcecodecategry SET category = '%s', status = '%d' WHERE id=%d",
		$conn->real_escape_string($category),
		$conn->real_escape_string($status),
		$conn->real_escape_string($id)
	);

	$rs = $conn->query($query);

	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		"sourcecategorys" => array(
			"id" => $id,
			"category" => $category,
			"status"=>$status
		)
	));
?>