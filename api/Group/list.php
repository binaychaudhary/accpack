<?php
	//chama o arquivo de conexão com o bd
	include("../../includes/conectar.php");
	$start = $_REQUEST['start'];
	$limit = $_REQUEST['limit'];


	$queryString = "SELECT g.*, n.nature from groups g left join acnature n on g.natureId=n.id LIMIT $start,  $limit";

	//consulta sql
	$query = $conn->query($queryString) or die(mysqli_connect_error());

	//faz um looping e cria um array com os campos da consulta
	$cnt=0;
	$data = array();
	while($dat = mysqli_fetch_assoc($query)) {
		$cnt=$cnt+1;
	    $data[] = $dat;
	}

	
	//encoda para formato JSON
	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		"total" => $cnt,
		"qry" => $queryString,
		"groups" => $data
	));
?>