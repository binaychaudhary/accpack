<?php
	//chama o arquivo de conexão com o bd
	include("../../includes/conectar.php");
	$org_id = $_REQUEST['org_id'];
	$setting_name = $_REQUEST['setting_name'];

	$cr =" where org_id='".$org_id."'";
	if(!is_null($setting_name)){
		$cr = $cr. " and setting_name like '".$setting_name."%'";
	}
	$queryString="select * from app_setting".$cr." order by id";
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
		"appsettings" => $data
	));
?>