<?php
	//chama o arquivo de conexão com o bd
	include("../../../includes/conectar.php");
	$conn->query("SET NAMES utf8");  
	$start = $_REQUEST['start'];
	$limit = $_REQUEST['limit'];


	$queryString = "SELECT s.*, g.groupName from subgroup s left join groups g on s.groupId=g.id LIMIT $start,  $limit";

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
		"subgroups" => $data
	));
?>