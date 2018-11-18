<?php
	//chama o arquivo de conexão com o bd
	include("../../../includes/conectar.php");+
	$start = $_REQUEST['start'];
	$limit = $_REQUEST['limit'];
	

	$queryString = "SELECT rA.*, r.rights  FROM rightsAssigned rA join rights r on rA.rightId=r.id  LIMIT $start,  $limit";

	//consulta sql
	$query = $conn->query($queryString) or die(mysqli_connect_error());

	//faz um looping e cria um array com os campos da consulta
	$rights = array();
	$cnt=0;
	while($right = mysqli_fetch_assoc($query)) {
		$cnt = $cnt+1;
	    $rights[] = $right;
	}

	
	//encoda para formato JSON
	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		"total" => $cnt,
		"rights" => $rights
	));
?>