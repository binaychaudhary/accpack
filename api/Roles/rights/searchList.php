<?php
	//chama o arquivo de conexão com o bd
	include("../../../includes/conectar.php");
	$start = $_REQUEST['start'];
	$limit = $_REQUEST['limit'];
	$roleId=$_REQUEST['roleId'];
	$rightId=$_REQUEST['rightId'];
	$status=$_REQUEST['status'];
	$cr="";
	if(is_null($roleId)||($roleId=="")){
	}else{
		$cr=" where roleId = '".$roleId . "%'";
	}
	if(is_null($rightId)||($rightId=="")){
	}else{
		if($cr==""){
			$cr=" where rightId = '".$rightId . "%'";
		}else{
			$cr = $cr." and rightId = '".$rightId . "%'";
		}
	}
	if(is_null($status)||($status=="")){
	}else{
		if($cr==""){
			$cr=" where status = '".$status . "'";
		}else{
			$cr = $cr." and status = '".$status . "'";
		}
	}
	$queryString = "SELECT * FROM rightsAssigned ".$cr;"  LIMIT $start,  $limit";

	//consulta sql
	$query = $conn->query($queryString) or die(mysqli_connect_error());

	//faz um looping e cria um array com os campos da consulta
	$rights = array();
	$cnt=0;
	while($right = mysqli_fetch_assoc($query)) {
		$cnt = $cnt+1;
	    $rights[] = $right;
	}

	
	//encoda para formato JSON
	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		"total" => $cnt,
		"rights" => $rights
	));
?>