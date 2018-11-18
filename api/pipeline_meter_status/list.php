<?php
	//chama o arquivo de conexão com o bd
	include("../../includes/conectar.php");

	$status_name = $_REQUEST['status_name'];
	$cr="";
	if(is_null($status_name)||($status_name=="")){
	}else{
		if($cr==""){
			$cr=" where c.status_name like '%".$status_name . "%'";
		}else{
			$cr = $cr." and c.status_name like '%".$status_name . "%'";
		}
	}


	$queryString = "SELECT * from pipeline_meter_status order by id";

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
		"pipelinemeterstatus" => $data
	));
?>