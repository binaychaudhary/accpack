<?php
	//chama o arquivo de conexão com o bd
	include("../../includes/conectar.php");

	$info = $_POST['structurecodes'];

	$data = json_decode($info);
	$StructureCode=$data->StructureCode;
	$Description = $data->Description;
	$status = $data->status;

	
	//consulta sql
	$query = sprintf("INSERT INTO structurecode (StructureCode,Description,status) values ('%s','%s','%d')",
		$conn->real_escape_string($StructureCode),
		$conn->real_escape_string($Description),
		$conn->real_escape_string($status)
	);

	$rs = $conn->query($query);

	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		"structurecodes" => array(
			"id" => mysqli_insert_id($conn),
			"StructureCode" => $StructureCode,
			"Description"=>$Description,
			"status" => $status
		)
	));
?>