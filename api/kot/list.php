<?php
	//chama o arquivo de conexão com o bd
	include("../../includes/conectar.php");
	
	$table_id=$_REQUEST['table_id'];
	$user_id=$_REQUEST['user_id'];
	$entry_date_bs=$_REQUEST['entry_date_bs'];
	$status=$_REQUEST['status'];
	$cr="";
	
	if(is_null($table_id)||($table_id=="")){
	}else{
		if($cr==""){
			$cr=" where k.table_id = '".$table_id . "'";
		}else{
			$cr = $cr." and k.table_id = '".$table_id . "'";
		}
	}

	if(is_null($entry_date_bs)||($entry_date_bs=="")){
	}else{
		if($cr==""){
			$cr=" where k.entry_date_bs = '".$entry_date_bs . "'";
		}else{
			$cr = $cr." and k.entry_date_bs = '".$entry_date_bs . "'";
		}
	}
	
	if(is_null($user_id)||($user_id=="")){
	}else{
		if($cr==""){
			$cr=" where k.user_id = '".$user_id . "'";
		}else{
			$cr = $cr." and k.user_id = '".$user_id . "'";
		}
	}
	if(is_null($status)||($status=="")){
	}else{
		if($cr==""){
			$cr=" where k.status = '".$status . "'";
		}else{
			$cr = $cr." and k.status = '".$status . "'";
		}
	}

	$queryString = "SELECT k.*, l.location_name as table_name, s.staffName as user_name from kot k left join location l on k.table_id=l.id left join staff s on k.user_id = s.id".$cr;

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
		//"qry" => $queryString,
		"kots" => $data
	));
?>