<?php
	//chama o arquivo de conexão com o bd
	include("../../includes/conectar.php");
	
	$consumer_id = $_REQUEST['consumer_id'];

	$cr="";
	if(is_null($consumer_id)||($consumer_id=="")){
	}else{
		if($cr==""){
			$cr=" where cch.consumer_id = '".$consumer_id . "'";
		}else{
			$cr = $cr." and cch.consumer_id = '".$consumer_id . "'";
		}
	}

	$queryString = "SELECT cch.*, pms.status_name from consumer_connection_histry cch left join pipeline_meter_status pms on cch.status_id = pms.id".$cr;

	//consulta sql
	$query =$conn->query($queryString) or die(mysqli_connect_error());

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
		"consumerconnectionhistry" => $data
	));
?>