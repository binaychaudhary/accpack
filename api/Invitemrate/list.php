<?php
	//chama o arquivo de conexão com o bd
	include("../../includes/conectar.php");
	$itemId = $_REQUEST['itemId'];
	$salesRateTypeId=$_REQUEST['salesRateTypeId'];
	$cr="";
	if(!is_null($itemId)){
		$cr = " where invR.itemId='".$itemId."'";
	}
	if(!is_null($salesRateTypeId)){
		$cr = $cr." and invR.sales_rate_type_id='".$salesRateTypeId."'";
	}
	$queryString = "select invR.*, invI.item_name from inv_item_rate invR left join inv_item invI on invR.itemId = invI.id left join inv_sales_rate_type invst on invst.id = invR.sales_rate_type_id".$cr;

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
		"invitemrates" => $data
	));
?>