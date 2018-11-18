<?php
	//chama o arquivo de conexão com o bd
	include("../../includes/conectar.php");
	$info = $_POST['segments'];

	$data = json_decode($info);

	$name_np = $data->name_np;
	$name_en = $data->name_en;
	$ln = $data->ln;
	$auto=$data->Auto;
	$id = $data->id;

	//consulta sql
	$query = sprintf("UPDATE segment SET name_np = '%s', name_en = '%s', ln = '%d', Auto = '%s' WHERE id=%d",
		$conn->real_escape_string($name_np),
		$conn->real_escape_string($name_en),
		$conn->real_escape_string($ln),
		$conn->real_escape_string($auto),
		$conn->real_escape_string($id));

	$rs = $conn->query($query);

	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		"segments" => array(
			"id" => $id,
			"name_np" => $name_np,
			"name_en" => $name_en,
			"ln" => $ln,
			"Auto"=>$auto
		)
	));
?>