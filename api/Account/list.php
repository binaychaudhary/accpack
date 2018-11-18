<?php
	//chama o arquivo de conexão com o bd
	include("../../includes/conectar.php");
	$start = $_REQUEST['start'];
	$limit = $_REQUEST['limit'];

	$queryString = "SELECT a.*, concat(a.accountNo,'  ',a.accountDesc) as account, s.subGroupName as subgroup, n.nature, acgr.group_name from acmaster a left join subgroup s on a.subgroupId= s.id left join acnature n on a.natureId = n.id left join ac_group acgr on acgr.id = a.ac_group LIMIT $start,  $limit";

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
		"accountnos" => $data
	));
?>