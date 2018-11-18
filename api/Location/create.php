<?php
	//chama o arquivo de conexão com o bd
	include("../../includes/conectar.php");

	$info = $_POST['locations'];

	$data = json_decode($info);
	$location_name=$data->location_name;

	//consulta sql
	$query = sprintf("INSERT INTO location (location_name) values ('%s')",
		$conn->real_escape_string($location_name)
	);

	$rs = $conn->query($query);

	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		"locations" => array(
			"id" => mysqli_insert_id($conn),
			"location_name"=>$location_name
		)
	));
?>