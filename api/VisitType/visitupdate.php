<?php
	//chama o arquivo de conexão com o bd
	include_once("../../includes/conectar.php");
	$info = $_POST['visittypes'];

	$data = json_decode($info);
	$id=$data->id;
	$vdescription = $data->vdescription;
	$status=$data->status;
	
	

	//consulta sql
	$query = sprintf("UPDATE visit_type SET vdescription = '%s', status = '%d' WHERE id=%d",
		$conn->real_escape_string($vdescription),
		$conn->real_escape_string($status),
		$conn->real_escape_string($id)
	);

	$rs = $conn->query($query);

	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		"visittypes" => array(
			"id" => $id,
			"vdescription" => $vdescription,
			"status"=>$status
		)
	));
?>