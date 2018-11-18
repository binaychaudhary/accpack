<?php
	//chama o arquivo de conexão com o bd
	include("../../includes/conectar.php");
	$structureId = $_REQUEST['structureId'];

	$queryString = "SELECT count(*) as cnt from acmaster where structureId='".$structureId."'";

	//consulta sql
	$rs = $conn->query($queryString) or die(mysqli_connect_error());
	//faz um looping e cria um array com os campos da consulta
	$cnt=0;
	if(mysqli_num_rows($rs)>0){
		$dat = mysqli_fetch_assoc($rs);
		$cnt=$dat['cnt'];
	}else{
		$cnt=0;
	}
	    

	//encoda para formato JSON
	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		"total" => $cnt
	));
?>