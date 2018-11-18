<?php
	//chama o arquivo de conexão com o bd
	include_once("../../includes/conectar.php");
	$info = $_POST['roomtypes'];

	$data = json_decode($info);
	$id=$data->id;
	$rdescription = $data->rdescription;
	$status=$data->status;
	
	

	//consulta sql
	$query = sprintf("UPDATE room_type SET rdescription = '%s', status = '%d' WHERE id=%d",
		$conn->real_escape_string($rdescription),
		$conn->real_escape_string($status),
		$conn->real_escape_string($id)
	);

	$rs = $conn->query($query);

	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		"roomtypes" => array(
			"id" => $id,
			"rdescription" => $rdescription,
			"status"=>$status
		)
	));
?>