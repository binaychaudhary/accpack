<?php
	//chama o arquivo de conexão com o bd
	include("../../includes/conectar.php");
	$mainMenuId=$_REQUEST['mainMenuId'];
	$cr="";
	if(!is_null($mainMenuId)){
		$cr=" where mainmenuId	='".$mainMenuId."'";
	}
	$queryString = "SELECT * from submenu".$cr;

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
		"submenus" => $data
	));
?>