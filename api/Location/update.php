<?php
	//chama o arquivo de conexão com o bd
	include_once("../../includes/conectar.php");
	//sql_query("SET NAMES utf8");  
	$info = $_POST['locations'];

	$data = json_decode($info);
	$id = $data->id;
	$location_name=$data->location_name;

	//consulta sql
	$query = sprintf("UPDATE location SET location_name = '%s' WHERE id=%d",
		$conn->real_escape_string($location_name),
		$conn->real_escape_string($id)
		);
	$rs = $conn->query($query);

	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		"locations" => array(
			"id" => $id,
			"location_name"=>$location_name
		)
	));
?>