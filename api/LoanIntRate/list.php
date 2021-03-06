<?php
	//chama o arquivo de conexão com o bd
	include("../../includes/conectar.php");
	
	$queryString = "SELECT g.*, sg.subGroupName as subGroupDesc, sg.subGroupCode, mp.periodDesc as matureType from loanintrate g left join subgroup sg on g.subgroupId=sg.id left join matureperiod mp on g.matureTypeId = mp.id";

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
		"loanintrates" => $data
	));
?>