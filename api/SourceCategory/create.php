<?php
	//chama o arquivo de conexão com o bd
	include("../../includes/conectar.php");

	$info = $_POST['sourcecategorys'];

	$data = json_decode($info);
	
	$category = $data->category;
	$status=$data->status;
	

	//consulta sql
	$query = sprintf("INSERT INTO sourcecodecategory (category,status) values ('%s','%d')",
		$conn->real_escape_string($category),
		$conn->real_escape_string($status)
	);

	$rs = $conn->query($query);

	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		"sourcecategorys" => array(
			"id" => mysqli_insert_id($conn),
			"category" => $category,
			"status"=>$status
		)
	));
?>