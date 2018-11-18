<?php
	//chama o arquivo de conexão com o bd
	include_once("../../includes/conectar.php");
	

	$queryString = "SELECT * FROM sourcecodecategory";

	//consulta sql
	$rs = $conn->query($queryString) or die(mysqli_connect_error());

	//faz um looping e cria um array com os campos da consulta
	$datas = array();
	$sn=0;
	while($dat = mysqli_fetch_assoc($rs)) {
		$sn=$sn+1;
	    $datas[] = $dat;
	}

	

	//encoda para formato JSON
	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		"total" => $sn,
		"category" => $datas
	));
?>