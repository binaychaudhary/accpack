<?php
	//chama o arquivo de conexão com o bd
	include_once("../../includes/conectar.php");
	$info = $_POST['services'];

	$data = json_decode($info);
	$id=$data->id;
	$sdescription = $data->sdescription;
	$status=$data->status;
	
	

	//consulta sql
	$query = sprintf("UPDATE service SET sdescription = '%s', status = '%d' WHERE id=%d",
		$conn->real_escape_string($sdescription),
		$conn->real_escape_string($status),
		$conn->real_escape_string($id)
	);

	$rs = $conn->query($query);

	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		"services" => array(
			"id" => $id,
			"sdescription" => $sdescription,
			"status"=>$status
		)
	));
?>