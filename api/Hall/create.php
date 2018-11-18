<?php
	//chama o arquivo de conexão com o bd
	include("../../includes/conectar.php");

	$info = $_POST['halls'];

	$data = json_decode($info);
	
	$hall_name = $data->hall_name;
	$size = $data->size;
	$capacity = $data->capacity;
	$status=$data->status;

	//consulta sql
	$query = sprintf("INSERT INTO hall (hall_name,size,capacity,status) values ('%s','%d','%d','%d')",
		$conn->real_escape_string($hall_name),
		$conn->real_escape_string($size),
		$conn->real_escape_string($capacity),
		$conn->real_escape_string($status)
	);

	$rs = $conn->query($query);

	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		"halls" => array(
			"id" => mysqli_insert_id($conn),
			"hall_name" => $hall_name,
			"size" => $size,
			"capacity" => $capacity,
			"status"=>$status
		)
	));
?>