<?php
	//chama o arquivo de conexão com o bd
	include("../../includes/conectar.php");

	$info = $_POST['visittypes'];

	$data = json_decode($info);
	
	$vdescription = $data->vdescription;
	$status=$data->status;

	//consulta sql
	$query = sprintf("INSERT INTO visit_type (vdescription,status) values ('%s','%d')",
		$conn->real_escape_string($vdescription),
		$conn->real_escape_string($status)
	);

	$rs = $conn->query($query);

	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		"visittypes" => array(
			"id" => mysqli_insert_id($conn),
			"vdescription" => $vdescription,
			"status"=>$status
		)
	));
?>