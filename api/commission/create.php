<?php
	//chama o arquivo de conexão com o bd
	include("../../includes/conectar.php");

	$info = $_POST['commissionrate'];

	$data = json_decode($info);
	$sub_group_id=$data->sub_group_id;
	$sub_group_desc=$data->sub_group_desc;
	$rate = $data->rate;
	$status = $data->status;
	
	//consulta sql
	$query = sprintf("INSERT INTO commission_rate (sub_group_id, sub_group_desc, rate, status) values ('%d','%s','%s','%d')",
		$conn->real_escape_string($sub_group_id),
		$conn->real_escape_string($sub_group_desc),
		$conn->real_escape_string($rate),
		$conn->real_escape_string($status)
	);

	$rs = $conn->query($query);

	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		"commissionrate" => array(
			"id" => mysqli_insert_id($conn),
			"sub_group_id" => $sub_group_id,
			"sub_group_desc" => $sub_group_desc,
			"rate"=>$rate,
			"status"=>$status
		)
	));
?>