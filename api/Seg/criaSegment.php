<?php
	//chama o arquivo de conexão com o bd
	include("../../includes/conectar.php");
	$info = $_POST['segments'];

	$data = json_decode($info);

	$name_np = $data->name_np;
	$name_en = $data->name_en;
	$ln = $data->ln;
	$auto = $data->Auto;

	//consulta sql
	$query = sprintf("INSERT INTO Segment (name_np, name_en, ln, Auto) values ('%s', '%s', '%d', '%s')",
		$conn->real_escape_string($name_np),
		$conn->real_escape_string($name_en),
		$ln,
		$conn->real_escape_string($auto)
		);

	$rs = $conn->query($query);

	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		"segments" => array(
			"id" => mysqli_insert_id($conn),
			"name_np" => $name_np,
			"name_en" => $name_en,
			"ln" => $ln,
			"Auto"=>$auto
		)
	));
?>