<?php
	//chama o arquivo de conexão com o bd
	include("../../includes/conectar.php");
	$id = $_REQUEST['id'];
	
	$queryString = "SELECT * FROM segment where id='".$id."'";

	//consulta sql
	$query = $conn->query($queryString) or die(mysqli_connect_error());

	//faz um looping e cria um array com os campos da consulta
	$segments = array();
	while($segment = mysqli_fetch_assoc($query)) {
	    $segments[] = $segment;
	}

	//encoda para formato JSON
	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		"detail" => $segments
	));
?>