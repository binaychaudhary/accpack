<?php
	//chama o arquivo de conexão com o bd
	include("../../includes/conectar.php");
	$info = $_POST['segmentdatas'];

	$data = json_decode($info);

	$name_np = $data->name_np;
	$name_en = $data->name_en;
	$segment_code = $data->segment_code;
	$segment_id=$data->segment_id;
	$id = $data->id;

	//consulta sql
	$query = sprintf("UPDATE segmentdata SET segment_code='%s', name_np = '%s', name_en = '%s' WHERE id=%d",
		$conn->real_escape_string($segment_code),
		$conn->real_escape_string($name_np),
		$conn->real_escape_string($name_en),
		$conn->real_escape_string($id));

	$rs = $conn->query($query);

	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		"segmentdatas" => array(
			"id" => $id,			
			"segment_id" => $segment_id,
			"segment_code" => $segment_code,
			"name_np" => $name_np,
			"name_en" => $name_en
		)
	));
?>