<?php
	//chama o arquivo de conexão com o bd
	include("../../includes/conectar.php");
	$mainItemId = $_REQUEST['mainItemId'];
	$cr ="";
	if(!is_null($mainItemId)){
		$cr = " where c.mainItemId='".$mainItemId."'";
	}

	$queryString = "SELECT c.*, i.item_name, u.ShortName as unit from composition c left join inv_item i on c.itemId = i.id left join unit u on c.unitId = u.id".$cr;

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
		"compositions" => $data
	));
?>