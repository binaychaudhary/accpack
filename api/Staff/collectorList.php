<?php
	//chama o arquivo de conexão com o bd
	include("../../includes/conectar.php");
	
	
	$queryString = "SELECT id, staffName from staff where designationId=3";

	//consulta sql
	$rs = $conn->query($queryString) or die(mysqli_connect_error());

	//faz um looping e cria um array com os campos da consulta
	$cnt=0;
	$data = array();
	while($dat = mysqli_fetch_assoc($rs)) {
		$cnt=$cnt+1;
	    $data[] = $dat;
	}

	
	//encoda para formato JSON
	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		"total" => $cnt,
		"staffs" => $data
	));
?>