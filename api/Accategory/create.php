<?php
	//chama o arquivo de conexão com o bd
	include("../../includes/conectar.php");

	$info = $_POST['accategorys'];

	$data = json_decode($info);
	
	$acCategory = $data->acCategory;
	$status=$data->status;
	
	//consulta sql
	$query = sprintf("INSERT INTO accategory (acCategory,status) values ('%s','%d')",
		$conn->real_escape_string($acCategory),
		$conn->real_escape_string($status)
	);

	$rs = $conn->query($query);

	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		"accategorys" => array(
			"id"=>mysqli_insert_id($conn),
			"acCategory" => $acCategory,
			"status" => $status
		)
	));
?>