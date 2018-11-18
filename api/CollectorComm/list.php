<?php
	//chama o arquivo de conexão com o bd
	include("../../includes/conectar.php");
	$mahinaId = $_REQUEST['mahinaId'];
	$cr ="";
	if(!is_null($mahinaId)){
		$cr =" where ma.mahinaId ='".$mahinaId."'";
	}
	$queryString = "SELECT cc.*, co.staffName as collectorName, ma.mahina, sg.subGroupName from collector_commission cc left join staff co on cc.collector_id = co.id left join mahina ma on cc.month_id = ma.mahinaId left join subgroup sg on cc.sub_group_code = sg.id".$cr;

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
		"collectorcomm" => $data
	));
?>