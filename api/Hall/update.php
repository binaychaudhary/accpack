<?php
	//chama o arquivo de conexão com o bd
	include_once("../../includes/conectar.php");
	$info = $_POST['halls'];

	$data = json_decode($info);
	$id=$data->id;
	$hall_name = $data->hall_name;
	$size = $data->size;
	$capacity = $data->capacity;
	$status=$data->status;

	
	

	//consulta sql
	$query = sprintf("UPDATE hall SET hall_name = '%s',size='%d',capacity='%d', status = '%d' WHERE id=%d",
		$conn->real_escape_string($hall_name),
		$conn->real_escape_string($size),
		$conn->real_escape_string($capacity),
		$conn->real_escape_string($status),
		$conn->real_escape_string($id)
	);

	$rs = $conn->query($query);

	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		"halls" => array(
			"id" => $id,
			"hall_name" => $hall_name,
			"size" => $size,
			"capacity" => $capacity,
			"status"=>$status
		)
	));
?>