<?php
	//chama o arquivo de conexão com o bd
	include("../../includes/conectar.php");

	$info = $_POST['guesttypes'];

	$data = json_decode($info);

	$id = $data->id;

	//consulta sql
	$query = sprintf("DELETE FROM guest_register WHERE id=%d",
		$conn->real_escape_string($id));

	$rs = mysqli_query($conn, $query);

	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0
	));
?>