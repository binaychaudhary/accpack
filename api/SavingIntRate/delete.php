<?php
	//chama o arquivo de conexão com o bd
	include("../../includes/conectar.php");

	$info = $_POST['savingintrates'];

	$data = json_decode($info);

	$id = $data->id;

	//consulta sql
	$query = sprintf("DELETE FROM saving_int_rate WHERE id=%d",
		$conn->real_escape_string($id));

	$rs = $conn->query($query);

	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0
	));
?>