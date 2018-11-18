<?php
	//chama o arquivo de conexão com o bd
	include("../../includes/conectar.php");

	$info = $_POST['roomtypes'];

	$data = json_decode($info);
	
	$rdescription = $data->rdescription;
	$status=$data->status;

	//consulta sql
	$query = sprintf("INSERT INTO room_type (rdescription,status) values ('%s','%d')",
		$conn->real_escape_string($rdescription),
		$conn->real_escape_string($status)
	);

	$rs = $conn->query($query);

	echo json_encode(array(
		"success" => mysqli_connnect_errno() == 0,
		"roomtypes" => array(
			"id" => mysqli_insert_id($conn),
			"rdescription" => $rdescription,
			"status"=>$status
		)
	));
?>