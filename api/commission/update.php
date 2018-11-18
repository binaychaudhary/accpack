<?php
	//chama o arquivo de conexão com o bd
	include_once("../../includes/conectar.php");
	//mysql_query("SET NAMES utf8");  
	$info = $_POST['commissionrate'];

	$data = json_decode($info);
	$id = $data->id;
	$sub_group_id=$data->sub_group_id;
	$sub_group_desc=$data->sub_group_desc;
	$rate = $data->rate;
	$status = $data->status;
	
	
	//consulta sql
	$query = sprintf("UPDATE commission_rate SET sub_group_id = '%s', sub_group_desc='%s', rate='%d', status = '%d' WHERE id=%d",
		$conn->real_escape_string($sub_group_id),
		$conn->real_escape_string($sub_group_desc),
		$conn->real_escape_string($rate),
		$conn->real_escape_string($status),
		$conn->real_escape_string($id)
	);

	$rs = $conn->query($query);

	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		"commissionrate" => array(
			"id" => $id,
			"sub_group_id" => $sub_group_id,
			"sub_group_desc" => $sub_group_desc,
			"rate"=>$rate,
			"status"=>$status
		)
	));
?>