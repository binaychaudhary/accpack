<?php
	include("../../includes/conectar.php");
	$start = $_REQUEST['start'];
	$limit = $_REQUEST['limit'];


	$queryString = "SELECT e.*, s.sourceCode, a.accountDesc, sg.group_name  as groupDesc from tmpentry e left join sourcecode s on e.sourceCodeId=s.id left join acmaster a on e.accountNo=a.accountNo left join ac_group sg on e.ac_group=sg.id LIMIT $start,  $limit";

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
		"vouchers" => $data
	));
?>