<?php
	//chama o arquivo de conexão com o bd
	include_once("../../includes/conectar.php");
	$info = $_POST['beds'];

	$data = json_decode($info);
	$id=$data->id;
	$bdescription = $data->bdescription;
	$status=$data->status;
	
	

	//consulta sql
	$query = sprintf("UPDATE bed_type SET bdescription = '%s', status = '%d' WHERE id=%d",
		$conn->real_escape_string($bdescription),
		$conn->real_escape_string($status),
		$conn->real_escape_string($id)
	);

	$rs = mysqli_connect_query($query);

	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		"beds" => array(
			"id" => $id,
			"bdescription" => $bdescription,
			"status"=>$status
		)
	));
?>