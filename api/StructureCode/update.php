<?php
	//chama o arquivo de conexão com o bd
	include_once("../../includes/conectar.php");
	//mysql_query("SET NAMES utf8");  
	$info = $_POST['structurecodes'];

	$data = json_decode($info);
	$id = $data->id;
	$StructureCode=$data->StructureCode;
	$Description=$data->Description;
	$status = $data->status;
	
	//consulta sql
	$query = sprintf("UPDATE structurecode SET StructureCode = '%s', Description='%s', status = '%d' WHERE id=%d",
		$conn->real_escape_string($StructureCode),
		$conn->real_escape_string($Description),
		$conn->real_escape_string($status),
		$conn->real_escape_string($id)
	);

	$rs = $conn->query($query);

	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		"structurecodes" => array(
			"id" => $id,
			"StructureCode" => $StructureCode,
			"Description"=>$Description,
			"status" => $status
		)
	));
?>