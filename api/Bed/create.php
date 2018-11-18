<?php
	//chama o arquivo de conexão com o bd
	include("../../includes/conectar.php");

	$info = $_POST['beds'];

	$data = json_decode($info);
	
	$bdescription = $data->bdescription;
	$status=$data->status;

	//consulta sql
	$query = sprintf("INSERT INTO bed_type (bdescription,status) values ('%s','%d')",
		$conn->real_escape_string($bdescription),
		$conn->real_escape_string($status)
	);

	$rs = $conn->query($query);

	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		"beds" => array(
			"id" => mysqli_insert_id($conn),
			"bdescription" => $bdescription,
			"status"=>$status
		)
	));
?>